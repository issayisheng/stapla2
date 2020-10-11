<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
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
        return Gym::paginate(6);
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
        $gym = Gym::FindOrFail($id); // ジム詳細データ

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
        $calendar = Calendar::whereBetween('date', [$from, $to])
                    ->where('gym_id', $id)
                    ->orderBy('day', 'asc')
                    ->get(['id','time','day','day_name_ja','month','reserved','is_sunday','is_saturday','date']);

        return response()->json(['gym' => $gym, 'calendar' => $calendar, 'pasts' => $pasts]);
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
        $now = new Carbon($request->time);
        $month = $now->format('m');

        $from = $now->copy();
        $to   = $now->copy()->addweek(1)->subday();
        
        // カレンダー設定
        $calendar = Calendar::whereBetween('date', [$from, $to])
                    ->where('gym_id', $id)
                    ->orderBy('month', 'asc')
                    ->orderBy('day', 'asc')
                    ->get(['id','time','day','day_name_ja','month','reserved','is_sunday','is_saturday','date']);
        
        return response()->json(['calendar' => $calendar, 'month' => $month]);
    }


    // 前週
    public function prevWeek($id, Request $request)
    {
        $gym = Gym::FindOrFail($id);


        // 日付をmoment.jsで取得、送信
        $now = new Carbon($request->time);
        $month = $now->format('m');

        
        // 期間
        $from = $now->copy()->subday()->addday();
        $to   = $now->copy()->addweek()->subday();


        // カレンダー設定
        $calendar = Calendar::whereBetween('date', [$from, $to])
        ->where('gym_id', $id)
        ->orderBy('month', 'asc')
        ->orderBy('day', 'asc')
        ->get(['id','time','day','day_name_ja','month','reserved','is_sunday','is_saturday','date']);


        // DBに値があるか
        $exists = Calendar::where('date', [$from, $to])->exists();
        if ($exists) {
            return response()->json(['calendar' => $calendar, 'month' => $month]);
        } else {
            return response()->json(['calendar' => $calendar, 'month' => $month, 'exists' => $exists]);
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

                    // user_idを挿入、 予約済みに変更
                    $calendar = Calendar::where('id', $request->id)->first();
                    $calendar->user_id = $user;
                    $calendar->reserved = true;
                    $calendar->status = '1';   // 予約済みに変更
                    $calendar->save();


                    // チケット残数を1枚減らす
                    $ticket_num = '1';
                    $ticket->quantity -= $ticket_num;
                    $ticket->save();


                    // 日付取得
                    $date = $calendar->date;
                    $date_format = date_format($date, 'Y年m月d日');
                    // 時間取得(変換)
                    $time = date('H:i', strtotime($calendar->time));

                    // 履歴作成
                    History::create([
                    'user_id'      =>  $user,
                    'order'        =>  '-1',
                    'description'  =>   "$date_format $time の予約分",
                ]);
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
