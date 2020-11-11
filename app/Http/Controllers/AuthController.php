<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite; // Socialite
use App\User;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','socialLogin','handleProviderCallback']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        if (! $token = auth()->attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'ログイン情報が登録されていません。'], 401);
        }

        return response()->json(compact('token'));
    }


    /**
     * Socialite
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
            $user = new User;
            $user->provider_id = $userSocial->getId();
            $user->name = $userSocial->getName();
            $user->email = $userSocial->getEmail();
            // ユーザ作成
            $user->save();
            // ログインしてdashboardにリダイレクト
            Auth::login($newuser);
            return redirect('/dashboard');
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'id' => $user->id,
            'email' => $user->email,
            'name' => $user->name,
            'status' => $user->status,
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            return $this->respondWithToken(auth()->refresh());
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
