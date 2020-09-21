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


Route::group(['prefix' => 'settings'], function () {
    Route::apiResources([
        'gym_info' => 'GymController',         // ジム設定
        'user_info' => 'UserInfoController' ,  // ユーザー設定
        'reserved'  => 'ReservedController',   // 予約情報
        'history'   => 'HistoryController',    // チケット履歴
        'ticket'    => 'TicketController',     // チケット残数
        'trainer'   => 'TrainerController',    // トレーナー管理
    ]);

    // パスワード設定
    Route::post('user_info/password', 'UserInfoPasswordController@store')->name('user_info.password.store');
    Route::get('user_info/password/edit/{id}', 'UserInfoPasswordController@edit')->name('user_info.password.edit');
    Route::post('user_info/password/update/{id}', 'UserInfoPasswordController@update')->name('user_info.password.update');
});


Route::apiResources([
    'gym'       => 'MainGymController',         // ジム設定
]);



// Stripeの支払情報
Route::post('/charge', 'ChargeController@charge')->name('charge');


// 住所検索
Route::get('/zipcode', 'GymController@getZipInfo');



// Route::post('/login', 'Api\AuthController@login');

// Route::post('/register', 'Auth\RegisterController@register')->name('register');  // 会員登録
// Route::post('/login', 'Auth\LoginController@login')->name('login');             // ログイン
