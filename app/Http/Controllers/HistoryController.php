<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;
use App\Models\Ticket;
use App\Models\Calendar;
use App\Models\HistoryCancel;
use App\Http\Requests\TicketContactRequest;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::id();

        // 10件ごとにページネーション
        $history = History::select('id', 'description', 'order', 'status', 'created_at')
                            ->where('user_id', $user)
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        $ticket = Ticket::select('quantity')
                        ->where('user_id', $user)
                        ->first();


        return response()->json(['history' => $history, 'ticket' => $ticket]);
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
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // チケット枚数、購入日時を返す
        return History::select('order', 'created_at')
                        ->where('id', $id)
                        ->firstOrFail();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        //
    }

    public function contact(TicketContactRequest $request, $id)
    {
        // キャンセル理由を記入
        $reason = $request->reason;
        $cancel = new HistoryCancel;
        $cancel->history_id   = $id;
        $cancel->reason       = $reason;
        $cancel->save();

        // ステータス変更
        $history = History::FindOrFail($id);
        $history->status   = '10';
        $history->save();

        // 予約メール送信
        $user = Auth::user();
        Mail::to($user)
        // ->bcc('admin@stapla.com')
        ->queue(new TicketContact($data));
    }
}
