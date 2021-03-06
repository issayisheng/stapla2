<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function contact(Request $request)
    {
        // 10/4 まだ
        // $validator = $request->validate([
        //     'textarea'   => 'required',
        // ]);
        // $users = History::find($id);
        // $users->save();
    }
}
