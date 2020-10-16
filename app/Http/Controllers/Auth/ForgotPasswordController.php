<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\ForgetPasswordRequest;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }

    // ここ以下、追加
    public function sendResetLinkEmail(ForgetPasswordRequest $request)
    {
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($request, $response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

    protected function sendResetLinkResponse()
    {
        return response()->json(['send' => 'パスワードリセットメールを送信しました。']);
    }

    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        return response()->json(['failed' => trans($response)]);
    }
}
