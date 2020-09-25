<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\History;
use App\User;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // try内に記述すると失敗した時にcatchに拾われてrollBackが走るのでtry前に記述
        DB::beginTransaction();
        try {
            Stripe::setApiKey('sk_test_51HFuIFFuVe19htwq23yg5d6SAB07PlxqQK29938g0VnEvWf9a3BUBrJFwzKDU0lpjOcVXxpFEGQOJeb2VRukOAk100AnskWtEX');
        
            header('Content-Type: application/json');

            //postされてきたdataを変数にいれる
            // $quantity = $request->plan;

            // // 条件分岐
            // if ($quantity == 'BASIC') {
            //     $quantity = 10;
            //     $unit_amount = 3300;  // 単価(税込)
            //     $product_description = 'チケット10枚分';
            // }
        
            // if ($quantity == 'PLUS') {
            //     $quantity = 20;
            //     $unit_amount = 3080;   // 単価(税込)
            //     $product_description = 'チケット20枚分';
            // }

            // if ($quantity == 'PRO') {
            //     $quantity = 30;
            //     $unit_amount = 2750;   // 単価(税込)
            //     $product_description = 'チケット30枚分';
            // }


            // // 登録済みユーザーがあれば、Ticket枚数を更新する
            // // 一致するモデルがなければ、作成する
            // $ticket = Ticket::where('user_id', Auth::id())->first();
            // if (empty($ticket)) {
            //     $ticket = Ticket::create([
            //         'user_id'    => Auth::id(),
            //         'quantity'   => $quantity,
            //     ]);
            // } else {
            //     $ticket->quantity += $quantity;
            //     $ticket->save();
            // }


            // // 購入履歴を作成する
            // $history = History::create([
            //     'user_id'    => Auth::id(),
            //     'order'      => $quantity,
            // ]);

            // Stripeを作成する
            $checkout_session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'locale' =>  'ja',
                'line_items' => [[
                    'quantity' => $quantity,
                    'price_data' => [
                        'currency' => 'jpy',
                        'unit_amount' => $unit_amount,
                        'product_data' => [
                            'name' => 'ジム予約チケット',
                            'images' => ["https://i.imgur.com/EHyR2nP.png"],
                            'description' => $product_description,
                        ],
                    ],
                ]],
                'mode' => 'payment',
                'success_url' => 'http://localhost.stapla.com/settings/ticket/success',
                'cancel_url' => 'http://localhost.stapla.com/settings/ticket/cancel',
            ]);
            DB::commit();
            return response()->json(['id' => $checkout_session->id]);
        } catch (Stripe\Error\Card $e) {
            DB::rollback();

            // 決済に失敗したらエラーメッセージを返す
            return response()->json([
                'success' => false,
                'errors' => $e->getMessage()
            ], 422);
        }
    }
}
