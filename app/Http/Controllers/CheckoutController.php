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

            // postされてきたdataを変数にいれる
            $quantity = $request->plan;

            // 条件分岐
            if ($quantity == 'BASIC') {
                $quantity = 10;
                $unit_amount = 3300;  // 単価(税込)
                $product_description = 'チケット10枚分';
                $product_images = 'https://picsum.photos/id/505/280/280';
            }
        
            if ($quantity == 'PLUS') {
                $quantity = 20;
                $unit_amount = 3080;   // 単価(税込)
                $product_description = 'チケット20枚分';
                $product_images = 'https://picsum.photos/id/1013/280/280';
            }

            if ($quantity == 'PRO') {
                $quantity = 30;
                $unit_amount = 2750;   // 単価(税込)
                $product_description = 'チケット30枚分';
                $product_images = 'https://i.imgur.com/EHyR2nP.png';
            }


            // Stripeを作成する
            $checkout_session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'locale' =>  'ja',                                  // 地域
                "metadata" => ["quantity" => $quantity],
                'line_items' => [[
                    'quantity' => $quantity,                        // 数量
                    'price_data' => [
                        'currency' => 'jpy',                        // 単位
                        'unit_amount' => $unit_amount,              // 金額
                        'product_data' => [
                            'name' => 'ジム予約チケット',             // 商品名
                            'images' => [$product_images],         // 商品画像URL
                            'description' => $product_description, // 商品説明
                        ],
                    ],
                ]],
                'mode' => 'payment',
                'payment_intent_data' => [
                    'description' => $product_description
                ],
                'success_url' => 'http://localhost.stapla.com/settings/ticket/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url'  => 'http://localhost.stapla.com/settings/ticket/cancel',
            ]);
            DB::commit();
            return response()->json(['id' => $checkout_session->id]);
        } catch (\Stripe\Exception\CardException $e) {
            DB::rollback();

            // 決済に失敗したらエラーメッセージを返す
            return response()->json([
                'success' => false,
                'errors' => $e->getMessage()
            ], 422);
        }
    }


    public function retrieveSession(Request $request, $session_id)
    {
        DB::beginTransaction();
        try {
            $stripe = Stripe::setApiKey('sk_test_51HFuIFFuVe19htwq23yg5d6SAB07PlxqQK29938g0VnEvWf9a3BUBrJFwzKDU0lpjOcVXxpFEGQOJeb2VRukOAk100AnskWtEX');

            // 購入履歴から情報を取得
            $session = \Stripe\Checkout\Session::retrieve($session_id);
            $quantity =  $session->metadata->quantity;
            $total =  $session->amount_total;


            // 登録済みユーザーがあれば、Ticket枚数を更新する
            // 一致するモデルがなければ、作成する
            $ticket = Ticket::where('user_id', Auth::id())->first();
            $ticket_exists = History::where('stripe_id', $session->id)->exists();
            if (empty($ticket)) {
                $ticket = Ticket::create([
                    'stripe_id'    => $session->id,
                    'user_id'       => Auth::id(),
                    'quantity'      => $quantity,
                ]);
            } elseif (!$ticket_exists) {
                $ticket->quantity += $quantity;
                $ticket->save();
            }
            //  Stripe(session)_idがない場合、購入履歴を作成する
            $history_exists = History::where('stripe_id', $session->id)->exists();
            if (!$history_exists) {
                History::create([
                'stripe_id'     => $session->id,
                'user_id'       => Auth::id(),
                'order'         => $quantity,
            ]);
            }

            DB::commit();
            return response()->json(['message' => 'ご購入ありがとうございます。お支払いが完了しました。','amount_total' => $total]);
        } catch (\Stripe\Exception\CardException $e) {
            DB::rollback();
            // 決済に失敗したらエラーメッセージを返す
            return response()->json([
                'success' => false,
                'errors' => $e->getMessage()
            ]);
        }
    }
}
