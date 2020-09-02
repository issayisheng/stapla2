<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite; // Socialite
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
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
