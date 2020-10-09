<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Calendar;
use App\Models\Ticket;
use App\Models\Cancel;
use App\Models\History;
use App\User;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();

        // 今日の日付取得
        $now = Carbon::now('Asia/Tokyo');


        // 外部キー(gym_id)を入れることでリレーション先も取得できる
        $calendar = Calendar::with('gyms:name,id')
                            ->select('id', 'status', 'time', 'date', 'day_name_ja', 'updated_at', 'gym_id')
                            ->where('user_id', $user)
                            ->where('reserved', '1')
                            ->orderBy('date', 'desc')
                            ->orderBy('time', 'asc')
                            ->paginate(10);

        // 現時刻以前は予約完了に
        $dates = Calendar::select('status', 'date', 'time')
                        ->where('user_id', $user)
                        ->where('date', '<', $now)
                        ->where('time', '<', $now)
                        ->get();
                        
        // 当日以前だったら
        foreach ($calendar as $date) {
            if ($now < $dates) {
                $date->status = '2';
                $date->save();
            }
        }

        return response()->json(['calendar' => $calendar]);
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
        // // 外部キー(gym_id)を入れることでリレーション先も取得できる
        return Calendar::with('gyms:name,id')
                        ->select('id', 'time', 'date', 'day_name_ja', 'gym_id')
                        ->where('id', $id)
                        ->firstOrFail();
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


    // キャンセル
    public function contact(Request $request, $id)
    {
        // キャンセル理由を記入
        $comment = json_encode($request->comment);
        Cancel::create([
            'calendar_id'    => $id,
            'reason'         => $request->comment['_value'],
        ]);


        // キャンセル済みに変更
        $calendar = Calendar::select('id', 'date', 'time', 'status')->where('id', $id)->first();
        $calendar->status = '10';  // キャンセル済み
        $date = $calendar->date;   // 日付取得
        $time = $calendar->time;   // 時間取得
        $date_format = date_format($date, 'Y年m月d日');

        
        // 当日以外のキャンセルはチケット1枚払い戻し
        $user = Auth::id();   // ログインID取得
        $ticket = Ticket::where('user_id', $user)->first();
        $now = Carbon::now('Asia/Tokyo');  //  今日の日付取得


        // 当日以前だったら
        if ($now < $date) {
            $ticket->quantity += '1';
            $ticket->save();

            // 履歴作成
            History::create([
                'user_id'      =>  Auth::id(),
                'order'        =>  '+1',
                'description'  =>  "$date_format $time チケット払い戻し",
            ]);
        } else {
            // 履歴作成
            History::create([
                'user_id'      =>  Auth::id(),
                'order'        =>  '0',
                'description'  =>  "当日キャンセル(払い戻しなし)",
            ]);
        }

        $calendar->save();
        return response()->json(['date' => $date, 'calendar' => $calendar]);
    }
}
