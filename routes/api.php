<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/user_info', function (Request $request) {
    return $users = Auth::user(); // ログイン中のユーザー情報
});


// Route::post('/login', 'Api\AuthController@login');


Route::get('calendar', 'Api\CalendarController@index');
