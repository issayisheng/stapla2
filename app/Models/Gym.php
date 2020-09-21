<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;  // uuid

class Gym extends Model
{
    protected $table = 'gyms';

    protected $guarded = [''];

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
