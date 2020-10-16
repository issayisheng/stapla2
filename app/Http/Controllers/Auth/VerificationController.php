<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;
use App\User;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('throttle:6,1');
    }

    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));
        if (!$user->email_verified_at) {
            $user->markEmailAsVerified();
            event(new Verified($user));
            return response()->json(['verified' => '確認済みのメールです。']);
        }
        return response()->json(['failed' => 'メール認証に失敗しました。']);
    }

    public function resend(Request $request)
    {
        $user = User::where('email', $request->get('email'))->get()->first();
        if (!$user) {
            return response()->json(['such' => 'ユーザー登録がありません。']);
        }
        if ($user->hasVerifiedEmail()) {
            return response()->json(['already' => '既に確認済みのユーザーです。']);
        }

        $user->sendEmailVerificationNotification();

        return response()->json(['resend' => '確認のためのメールを送信しました。']);
    }
}
