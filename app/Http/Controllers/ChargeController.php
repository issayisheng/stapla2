<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\History;
use App\User;
use Stripe\Stripe;

class ChargeController extends Controller
{

    /* 単発決済用のコード */
    public function charge(Request $request)
    {
        // try内に記述すると失敗した時にcatchに拾われてrollBackが走るのでtry前に記述
        DB::beginTransaction();
        try {
            Stripe::setApiKey(config("services.stripe.secret"));
                
            $order = $request->input('order');

            // 条件分岐
            if ($order == 5) {
                $desc = 'チケット5枚分';
                $amonut = 1500;
            } elseif ($order == 10) {
                $desc = 'チケット10枚分';
                $amonut = 3000;
            }

            // Stripe上で顧客登録
            $customer = Customer::create(array(
                "name" => Auth::user()->name,
                'email' => $request->stripeEmail,
                'description' => $desc,
            ));

            // Stripe上で請求
            $charge = Charge::create(array(
                'amount' =>  $amonut ,
                'currency' => 'jpy',
                'source' => $request->stripeToken,
                'description' => $desc,
            ));
            
            // 登録済みユーザーがあれば、Ticket枚数を更新する
            // 一致するモデルがなければ、作成する
            $ticket = Ticket::where('user_id', Auth::id())->first();
            if (empty($ticket)) {
                $ticket = Ticket::create([
                    'user_id'    => Auth::id(),
                    'quantity'   => $order,
                ]);
            } else {
                $ticket->quantity += $order;
                $ticket->save();
            }

            // 購入履歴を作成する
            $history = History::create([
                'user_id'    => Auth::id(),
                'order'      => $order,
            ]);

            DB::commit();
            return back()->with('charge_message', 'お支払いが完了しました。');
        } catch (\Exception $ex) {
            DB::rollback();
            $errors = $ex->getMessage();
            return back()->with('errors', "決済に失敗しました。しばらく経ってから再度お試しください。");
        }
    }


    // public function session()
    // {
    //     Stripe::setApiKey('sk_test_51HFuIFFuVe19htwq23yg5d6SAB07PlxqQK29938g0VnEvWf9a3BUBrJFwzKDU0lpjOcVXxpFEGQOJeb2VRukOAk100AnskWtEX');
        
    //     header('Content-Type: application/json');
    
    //     $checkout_session = \Stripe\Checkout\Session::create([
    //         'payment_method_types' => ['card'],
    //         'line_items' => [[
    //             'price_data' => [
    //                 'currency' => 'usd',
    //                 'unit_amount' => 2000,
    //                 'product_data' => [
    //                     'name' => 'Stubborn Attachments',
    //                     'images' => ["https://i.imgur.com/EHyR2nP.png"],
    //                 ],
    //             ],
    //             'quantity' => 1,
    //         ]],
    //         'mode' => 'payment',
    //         'success_url' => 'http://localhost.stapla.com/settings/ticket',
    //         'cancel_url' => 'http://localhost.stapla.com/settings/reserved',
    //     ]);
    //     echo json_encode(['id' => $checkout_session->id]);
    // }
}
