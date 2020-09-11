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


Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('top');
})->name('top');

Route::get('/privacy', function () {
    return view('common/privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('common/terms');
})->name('terms');


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
        Route::get('user_info', 'UserInfoController@index')->name('user_info.index');

        // パスワード設定
        Route::get('user_info/password/create', 'UserInfoPasswordController@create')->name('user_info.password.create');
        Route::post('user_info/password/create', 'UserInfoPasswordController@store')->name('user_info.password.store');
        Route::get('user_info/password/edits', 'UserInfoPasswordController@edits')->name('user_info.password.edits');
        Route::put('user_info/password/update', 'UserInfoPasswordController@update')->name('user_info.password.update');

        // 予約情報
        Route::resource('reserved', 'ReservedController', ['only' => ['index','edit','update']]);

        // チケット履歴
        Route::resource('history', 'HistoryController', ['only' => ['index']]);

        // Stripeの支払情報
        Route::post('/charge', 'ChargeController@charge')->name('charge');

        // チケット残数
        Route::resource('ticket', 'TicketController', ['only' => ['index','edit','update']]);

        // トレーナー管理
        Route::resource('trainer', 'TrainerController', ['only' => ['index','edit','update']]);

        // ジム設定
        Route::get('/gym', 'GymController@index')->name('gym.index');
        Route::get('/gym/create', 'GymController@create')->name('gym.create');
        Route::post('/gym/store', 'GymController@store')->name('gym.store');
        Route::get('/gym/{gym_id}', 'GymController@show')->name('gym.show');
        Route::get('/gym/{gym_id}/edit', 'GymController@edit')->name('gym.edit');
        Route::post('/gym/{gym_id}', 'GymController@update')->name('gym.update');

        // Vue.js
        Route::get('/{any}', function () {
            return view('userinfo.index');
        })->where('any', '.*');
    });
});


// Route::get('/{any}', function () {
//     return view('top');
// })->where('any', '.*');
