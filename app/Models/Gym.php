<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Gym extends Model
{
    protected $table = 'gyms';

    protected $fillable = [
        'close_id', 'owner_id',
        'name',
        'zip_code', 'prefecture', 'city', 'street','building',
        'tel', 'gym_facility', 'gym_image',
        'mon_opening_started', 'mon_opening_ended',
        'tue_opening_started', 'tue_opening_ended',
        'wed_opening_started', 'wed_opening_ended',
        'thu_opening_started', 'thu_opening_ended',
        'fri_opening_started', 'fri_opening_ended',
        'sut_opening_started', 'sut_opening_ended',
        'sun_opening_started', 'sun_opening_ended',
        'holi_opening_started', 'holi_opening_ended',
    ];

    public function reservations()
    {
        return $this->hasMany('App\Modles\Reservation', 'gym_id', 'id');
    }

    public function userGyms()
    {
        return $this->hasMany('App\Modles\Reservation', 'gym_id', 'id');
    }

    public function userCloses()
    {
        return $this->hasMany('App\Modles\GymClose', 'gym_id', 'id');
    }

    public function calendars()
    {
        return $this->hasOne('App\Modles\Calendar', 'gym_id', 'id');
    }
}
