<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Exception;
use App\Mail\GymReserved;
use App\Models\Calendar;
use App\Models\Ticket;
use App\Models\Gym;
use App\Models\History;
use App\User;
use Carbon\Carbon;

class ReserveController extends Controller
{
    /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
    public function index()
    {
        return Gym::select(['id','name','address','facility','introduction_pic'])
                    ->paginate(6);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // ジム詳細データ
        $gym = Gym::select(['name','introduction_pic'])
                    ->FindOrFail($id);

        // 本日の情報取得
        $now = Carbon::now('Asia/Tokyo');

        // 現時刻以前は予約不可に
        $pasts = Calendar::where('time', '<', $now)
                            ->where('date', '<', $now)
                            ->get();

        foreach ($pasts as $past) {
            $past->reserved = true;
            if ($past->user_id == null) {
                $past->status = '2';   // 完了に変更
            }
            $past->save();
        }

        // 期間
        $from = $now->today();
        $to = $now->copy()->addDays(6);


        // カレンダー設定
        $calendar = Calendar::select(['id','time','day','day_name_ja','month','reserved','is_sunday','is_saturday','date'])
                        ->whereBetween('date', [$from, $to])
                        ->where('gym_id', $id)
                        ->orderBy('month', 'asc')
                        ->orderBy('day', 'asc')
                        ->get();
    
        
        $first = $calendar[0]['month'];
        $last = $calendar[62]['month'];

        return response()->json(['gym' => $gym, 'calendar' => $calendar, 'first' => $first, 'last' => $last]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // 翌週
    public function nextWeek($id, Request $request)
    {
        $gym = Gym::FindOrFail($id);


        // 日付をmoment.jsで取得、送信
        $request_next = new Carbon($request->time);
        $format_now   = $request_next->format('Y-m-d H:i:s');

        
        // 本日2ヶ月以内のデータを表示
        $now = Carbon::now('Asia/Tokyo');
        $setYear  = $now->year;
        $setMonth = $now->month;
        $setDay   = $now->day;
        $setHour   = $now->hour;
        $setMinute  = $now->minute;
        $setSecond   = $now->second;
        $end_set = Carbon::create($setYear, $setMonth, $setDay, $setHour, $setMinute, $setSecond);
        $end = $end_set->copy()->addMonth(2)->format('Y-m-d H:i:s');

        // 期間
        $from = $request_next->copy();
        $to   = $request_next->copy()->addweek(1)->subday();

        // カレンダー設定
        $calendar = Calendar::select(['id','time','day_name_ja','year','month','day','reserved','is_sunday','is_saturday','date'])
                        ->whereBetween('date', [$from, $to])
                        ->where('gym_id', $id)
                        ->orderBy('year', 'asc')
                        ->orderBy('month', 'asc')
                        ->orderBy('day', 'asc')
                        ->get();

        $first = $calendar[0]['month'];
        $last = $calendar[62]['month'];

        // もし2ヶ月以上のデータは表示させない
        if ($format_now > $end) {
            return response()->json(['null' => false, 'end' => $end]);
        } else {
            return response()->json(['calendar' => $calendar, 'first' => $first, 'last' => $last]);
        }
    }


    // 前週
    public function prevWeek($id, Request $request)
    {
        $gym = Gym::FindOrFail($id);


        // 日付をmoment.jsで取得、送信
        $request_prev = new Carbon($request->time);
        $format_now =  $request_prev->format('Y-m-d');


        // 本日2ヶ月以内のデータを表示
        $now = Carbon::now('Asia/Tokyo');
        $setYear  = $now->year;
        $setMonth = $now->month;
        $setDay   = $now->day;
        $setHour   = $now->hour;
        $setMinute  = $now->minute;
        $setSecond   = $now->second;
        $end = Carbon::create($setYear, $setMonth, $setDay, $setHour, $setMinute, $setSecond)->format('Y-m-d');

        
        // 期間
        $from = $request_prev->copy()->subday()->addday();
        $to   = $request_prev->copy()->addweek()->subday();


        // カレンダー設定
        $calendar = Calendar::select(['id','time','day_name_ja','year','month','day','reserved','is_sunday','is_saturday','date'])
                        ->whereBetween('date', [$from, $to])
                        ->where('gym_id', $id)
                        ->orderBy('year', 'asc')
                        ->orderBy('month', 'asc')
                        ->orderBy('day', 'asc')
                        ->get();


        $first = $calendar[0]['month'];
        $last = $calendar[62]['month'];


        // もし2ヶ月以前のデータは表示させない
        if ($format_now < $end) {
            return response()->json(['null' => false, 'end' => $end , 'format_now' => $format_now]);
        } else {
            return response()->json(['calendar' => $calendar, 'first' => $first, 'last' => $last]);
        }
    }



    // モーダル（確認）
    public function confirm(Request $request)
    {
        $data = $request->all();
        return response()->json(['data' => $data ]);
    }



    // 予約情報を送信
    public function post(Request $request)
    {
        $user = Auth::id();

        DB::beginTransaction();
        try {
            $ticket_no = Ticket::with('users:id,id')->select('quantity', 'user_id')->where('user_id', $user)->exists();


            if ($ticket_no) {
                // レコードは存在する
                $ticket = Ticket::with('users:id,id')->where('user_id', $user)->first();
                if ($ticket->quantity == '0') {
                    return response()->json(['ticket' => 'failed']);
                } else {

                    // 予約済みに変更
                    $calendar = Calendar::where('id', $request->id)->first();
                    $calendar->user_id = $user;
                    $calendar->reserved = true;
                    $calendar->status = '1';   // 予約済みに変更
                    $calendar->save();


                    // チケット残数を1枚減らす
                    $ticket_num = '1';
                    $ticket->quantity -= $ticket_num;
                    $ticket->save();

                    // 中間テーブル
                    $users = Auth::user();
                    $users->calendars()->attach(
                        ['user_id' => $user],
                        ['calendar_id' => $request->id],
                    );
                    $users->save();

                    // 日付取得
                    $date = $calendar->date;
                    $date_format = date_format($date, 'Y年m月d日');
                    // 時間取得(変換)
                    $time = date('H:i', strtotime($calendar->time));
                    $tmp = strtotime('90 minute', strtotime($time));
                    $add_time = date('H:i', $tmp);
                    // 曜日取得
                    $week_date = date_create($date);
                    $week = array("日", "月", "火", "水", "木", "金", "土");
                    $w = (int)date_format($week_date, 'w');


                    // 履歴作成
                    History::create([
                        'user_id'      =>  $user,
                        'order'        =>  '-1',
                        'description'  =>   "$date_format ($week[$w]) $time 〜 $add_time の予約分",
                    ]);


                    // 予約メール送信
                    $user = Auth::user();
                    // $calendars = 'ララベル太郎';
                    Mail::to($user)->queue(new GymReserved($user));

                    // transaction
                    DB::commit();
                    return response()->json(['ticket' => 'success']);
                }
            } elseif (!$ticket_no) {
                // レコードは存在しない
                return response()->json(['ticket' => 'failed']);
            }
        } catch (\Exception $e) {
            DB::rollback();
        }
    }


    // 成功時表示する
    public function success($id)
    {
        $gym = Gym::FindOrFail($id); // ジム詳細データ
        return response()->json(['gym' => $gym]);
    }
}
