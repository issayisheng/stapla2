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



//Socialite
// Route::get('/login/{social}', 'LoginController@socialLogin')->where('social', 'facebook|google')->name('login.social');
// Route::get('/login/{social}/callback', 'LoginController@handleProviderCallback')->where('social', 'facebook|google')->name('login.social.callback');

Route::group(["middleware" => "api"], function () {
    // 認証が必要ないメソッド
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/register', 'Auth\RegisterController')->name('register');
        Route::post('/login', 'AuthController@login')->name('login');
        Route::post('/logout', 'AuthController@logout')->name('logout');
        Route::get('/me', 'AuthController@me')->name('me');
        Route::post('/refresh', 'AuthController@refresh')->name('refresh');

        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::post('password/reset/{token}', 'Auth\ResetPasswordController@reset')->name('password.reset');
        Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
        Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
    });
    
    Route::group(['middleware' => ['jwt.auth']], function () {
        // 認証が必要なメソッド
        Route::group(['prefix' => 'settings'], function () {
            Route::apiResources([
                'gym_info'     => 'GymController',          // ジム設定
                'user_info'    => 'UserInfoController' ,    // ユーザー設定
                'reservation'  => 'ReservationController',  // ユーザー設定
                'history'      => 'HistoryController',      // チケット履歴
                'ticket'       => 'TicketController',       // チケット残数
                'trainer'      => 'TrainerController',      // トレーナー管理
            ]);

            // お問い合わせ
            Route::post('/history/contact', 'HistoryController@contact')->name('history.contact');

            // 予約キャンセル
            Route::post('/reservation/contact/{id}', 'ReservationController@contact')->name('reservation.contact');


            // パスワード設定
            Route::post('user_info/password', 'UserInfoPasswordController@store')->name('user_info.password.store');
            Route::get('user_info/password/edit/{id}', 'UserInfoPasswordController@edit')->name('user_info.password.edit');
            Route::post('user_info/password/update/{id}', 'UserInfoPasswordController@update')->name('user_info.password.update');
        });



        Route::apiResources([
            'reserve'           => 'ReserveController',         // 予約
        ]);

        // 翌週・先週ページネーション
        Route::get('/reserve/next/{id}', 'ReserveController@nextWeek')->name('reserve.next');
        Route::get('/reserve/prev/{id}', 'ReserveController@prevWeek')->name('reserve.prev');

        // モーダル
        Route::post('/reserve/confirm', 'ReserveController@confirm')->name('reserve.confirm');
        
        // 予約情報
        Route::post('/reserve/post', 'ReserveController@post')->name('reserve.post');
        Route::get('/reserve/success/{id}', 'ReserveController@success')->name('reserve.success');


        // Stripe支払情報
        Route::post('/checkout', 'CheckoutController@checkout')->name('checkout');
        Route::get('/success/{session_id}', 'CheckoutController@retrieveSession')->name('retrieve');

        
        // 住所検索
        Route::get('/zipcode', 'GymController@getZipInfo')->name('zipcode');
    });
});
