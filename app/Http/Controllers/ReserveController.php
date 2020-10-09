<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $dt = Carbon::now('Asia/Tokyo');

        $from = $dt->today();  // 今日
        $to = $dt->copy()->addDays(6); // 1週間後


        // 現時刻以前は予約不可に
        $dates = Calendar::where('date', '<', $dt)
                        ->where('time', '<', $dt)
                        ->get();
        foreach ($dates as $date) {
            $date->reserved = true;
            if ($date->user_id == null) {
                $date->status = '2';   // 完了に変更
            }
            $date->save();
        }
        

        // カレンダー
        $calendar = Calendar::whereBetween('date', [$from, $to])
                    ->where('gym_id', $id)
                    ->orderBy('day', 'asc')
                    ->get(['id','time','day','day_name_ja','month','reserved','is_sunday','is_saturday','date']);

        return response()->json(['gym' => $gym, 'calendar' => $calendar]);
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

        $dt = Carbon::now('Asia/Tokyo');
        $week = $request->time; // 1
        $from = $dt->copy()->addweek($i)->subday();
        $to   = $dt->copy()->addweek($i + 1)->subday();
        
        
        // カレンダー
        $calendar = Calendar::whereBetween('date', [$from, $to])
                    ->where('gym_id', $id)
                    ->orderBy('day', 'asc')
                    ->get(['id','time','day','day_name_ja','month','reserved','is_sunday','is_saturday','date']);
        
        
        return response()->json(['calendar' => $calendar, 'week' => $week]);
    }


    // 前週
    public function prevWeek($id)
    {
        $gym = Gym::FindOrFail($id);

        $dt = Carbon::now('Asia/Tokyo');

        $from = $dt->copy()->subweek(1)->subday();
        $to = $dt->copy()->subday(1);
        

        // カレンダー
        $calendar = Calendar::whereBetween('date', [$from, $to])
                    ->where('gym_id', $id)
                    ->orderBy('month', 'asc')
                    ->orderBy('day', 'asc')
                    ->get(['id','time','day','day_name_ja','month','reserved','is_sunday','is_saturday','date']);
        
        return response()->json(['calendar' => $calendar]);
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


                // 履歴作成
                $date = $calendar->date;   // 日付取得
                $time = $calendar->time;   // 時間取得
                $date_format = date_format($date, 'Y年m月d日');

                History::create([
                    'user_id'      =>  $user,
                    'order'        =>  '-1',
                    'description'  =>   "$date_format $time の予約分",
                ]);
                
                return response()->json(['ticket' => 'success']);
            }
        } elseif (!$ticket_no) {
            // レコードは存在しない
            return response()->json(['ticket' => 'failed']);
        }
    }



    public function success($id)
    {
        $gym = Gym::FindOrFail($id); // ジム詳細データ
        return response()->json(['gym' => $gym]);
    }
}
