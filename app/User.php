<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use GoldSpecDigital\LaravelEloquentUUID\Foundation\Auth\User as Authenticatable; // UUID
use Tymon\JWTAuth\Contracts\JWTSubject;  // JWT
use App\Notifications\CustomPasswordReset; // Mail
use App\Notifications\VerifyEmail; // メール認証追加

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gym_id', 'name', 'email', 'password', 'status', 'tel',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // Mail
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomPasswordReset($token));
    }

    // Mail認証
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }


    // 予約中間テーブル
    public function calendars()
    {
        return $this->belongsToMany('App\Models\Calendar');
    }


    // ジムテーブル
    public function gyms()
    {
        return $this->hasMany('App\Models\Gym');
    }

    // 中間テーブル
    public function userGyms()
    {
        return $this->hasMany('App\Models\Gym', 'user_id', 'id');
    }

    // チケットテーブル
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    // 購入テーブル
    public function histories()
    {
        return $this->hasMany('App\Models\History');
    }
}
