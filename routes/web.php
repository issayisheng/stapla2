<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('top');
})->name('top');

Route::get('/privacy', function () {
    return view('common/privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('common/terms');
})->name('terms');


Auth::routes(['verify' => true]);


//Socialite
Route::get('/login/{social}', 'Auth\LoginController@socialLogin')->where('social', 'facebook|google')->name('login.social');
Route::get('/login/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'facebook|google')->name('login.social.callback');

/*
|--------------------------------------------------------------------------
| 認証後
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'settings'], function () {
        // ユーザー設定
        Route::resource('user_info', 'UserInfoController', ['only' => ['index','edit','update']]);
        // 予約情報
        Route::resource('reserved', 'ReservedController', ['only' => ['index','edit','update']]);
        // チケット履歴
        Route::resource('history', 'HistoryController', ['only' => ['index']]);
        // Stripeの支払情報
        Route::post('/charge', 'ChargeController@charge')->name('charge');
        // チケット残数
        Route::resource('ticket', 'TicketController', ['only' => ['index','edit','update']]);
    });
});

// vue.jsのルーティング
// Route::get('/member/{any}', function () {
//     return view('member.list');
// })->where('any', '.*');
