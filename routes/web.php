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

//Socialite
Route::get('/login/{social}', 'Auth\LoginController@socialLogin')->where('social', 'facebook|google')->name('login.social');
Route::get('/login/{social}/callback', 'Auth\LoginController@handleProviderCallback')->where('social', 'facebook|google')->name('login.social.callback');

/*
|--------------------------------------------------------------------------
| 認証後
|--------------------------------------------------------------------------
*/
Route::get('/{any}', function () {
    return view('top');
})->where('any', '.*');
