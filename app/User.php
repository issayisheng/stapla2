<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use GoldSpecDigital\LaravelEloquentUUID\Foundation\Auth\User as Authenticatable; // UUID
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;            // Stripe
use Tymon\JWTAuth\Contracts\JWTSubject;  // JWT

use App\Models\Ticket;
use App\Models\History;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable,Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gym_id', 'name', 'email', 'password', 'status', 'privilege_id', 'tel',
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

    

    public function reservations()
    {
        return $this->hasMany('App\Modles\Reservation', 'user_id', 'id');
    }

    public function userGyms()
    {
        return $this->hasMany('App\Modles\Reservation', 'user_id', 'id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
