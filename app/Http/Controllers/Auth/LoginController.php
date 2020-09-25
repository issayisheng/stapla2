<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite; // Socialite
use App\User;
use Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        if (!$token = auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json(compact('token'));
    }

    /**
     * socialite
     *
     */
    // ログインボタンからリンク
    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }
    
    // Callback処理
    public function handleProviderCallback($social)
    {
        // ソーシャルサービス（情報）を取得
        $userSocial = Socialite::driver($social)->stateless()->user();
        // メールアドレスで登録状況を調べる
        $user = User::where(['email' => $userSocial->getEmail()])->first();
        // メールアドレス登録の有無で分岐
        if ($user) {
            // 登録あればそのままログイン（2回目以降）
            Auth::login($user);
            return redirect('/dashboard');
        } else {
            // メールアドレスがなければユーザ登録（初回）
            $newuser = new User;
            $newuser->provider_id = $userSocial->getId();
            $newuser->name = $userSocial->getName();
            $newuser->email = $userSocial->getEmail();
            // ユーザ作成
            $newuser->save();
            // ログインしてdashboardにリダイレクト
            Auth::login($newuser);
            return redirect('/dashboard');
        }
    }
}
