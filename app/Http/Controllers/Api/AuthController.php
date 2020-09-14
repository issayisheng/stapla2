<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // public function login(Request $request): JsonResponse
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         $token = $user->createToken('Laravel Password Grant Client')->accessToken;
    //         return new JsonResponse(['token' => $token], 200);
    //     }

    //     return new JsonResponse([
    //         'message' => 'Unauthenticated.'
    //     ], 401);
    // }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('my_token')->accessToken;
            return ['access_token' => $token];
        }
        return response([
            'message' => 'Unauthenticated.'
        ], 401);
    }
}
