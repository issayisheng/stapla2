<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\GymCanceled;
use App\Http\Requests\ReservationRequest;
use App\Models\Calendar;
use App\Models\Ticket;
use App\Models\CalendarCancel;
use App\Models\History;
use App\User;
use Carbon\Carbon;
use Exception;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        // 今日の日付取得
        $now = Carbon::now('Asia/Tokyo');


        // 外部キー(gym_id)を入れることでリレーション先も取得できる
        $calendar = Calendar::with('gyms:name,id')
                            ->select('id', 'status', 'time', 'date', 'day_name_ja', 'updated_at', 'gym_id')
                            ->where('user_id', $user_id)
                            ->where('reserved', '1')
                            ->orderBy('date', 'asc')
                            ->orderBy('time', 'asc')
                            ->paginate(10);
                            
        // 現時刻以前は予約完了に
        $dates = Calendar::select('status', 'date', 'time')
                        ->where('user_id', $user_id)
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
    public function contact(ReservationRequest $request, $id)
    {
        DB::beginTransaction();
        try {

            // キャンセル理由を記入
            $reason = $request->reason;
            $cancel = new CalendarCancel;
            $cancel->calendar_id   = $id;
            $cancel->reason        = $reason;
            $cancel->save();


            // キャンセル済みに変更
            $calendar = Calendar::select('id', 'date', 'time', 'status')->where('id', $id)->first();
            $calendar->status = '10';  // キャンセル済み


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
            

            // 当日以外のキャンセルはチケット1枚払い戻し
            $user_id = Auth::id();
            $ticket = Ticket::where('user_id', $user_id)->first();
            $now = Carbon::now('Asia/Tokyo');  //  今日の日付取得


            // 当日以外のキャンセル処理
            if ($now < $date) {
                // 予約可能に変更
                $calendar_cancel = Calendar::where('id', $request->id)->first();
                $calendar_cancel->user_id = null;
                $calendar_cancel->reserved = false;
                $calendar_cancel->status = '10';
                $calendar_cancel->save();

                // チケット払い戻し
                $ticket->quantity += '1';
                $ticket->save();

                // 履歴作成
                History::create([
                    'user_id'      =>  Auth::id(),
                    'order'        =>  '+1',
                    'description'  =>  "$date_format ($week[$w]) $time 〜 $add_time チケット払い戻し",
                ]);
            } else {
                History::create([
                    'user_id'      =>  Auth::id(),
                    'order'        =>  '0',
                    'description'  =>  "当日キャンセル(払い戻しなし)",
                ]);
            }

            // 予約メール送信
            $user = Auth::user();
            // $gymOwners = Calendar::with(['gyms:id,owner_id','gyms.users:email,id'])
            //                     ->where('id', $id)
            //                     ->select('id', 'gym_id')
            //                     ->get();
            // $calendars = Calendar::findOrFail($id);

            Mail::to($user)
            // ->bcc($gymOwners)
            ->queue(new GymCanceled($user));

            
            $calendar->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}
