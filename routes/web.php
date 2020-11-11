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

// Socialite
Route::get('/login/{social}', 'AuthController@socialLogin')->where('social', 'facebook|google')->name('login.social');
Route::get('/login/{social}/callback', 'AuthController@handleProviderCallback')->where('social', 'facebook|google')->name('login.social.callback');


Route::get('/{any}', function () {
    return view('top');
})->where('any', '.*');
