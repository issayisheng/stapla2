<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model; // uuid

class Calendar extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'time' => 'date("H:i")',
        'first_day_of_month' => 'date:Y-m-d',
        'last_day_of_month' => 'date:Y-m-d',
        'first_day_of_next_month' => 'date:Y-m-d',
        'first_day_of_quarter' => 'date:Y-m-d',
        'last_day_of_quarter' => 'date:Y-m-d',
        'first_day_of_year' => 'date:Y-m-d',
        'last_day_of_year' => 'date:Y-m-d',
        'first_day_of_next_year' => 'date:Y-m-d',
    ];

    public function gyms()
    {
        return $this->belongsTo('App\Models\Gym', 'gym_id', 'id');
    }

    public function cancels()
    {
        return $this->hasMany('App\Models\Calendar');
    }

    // ユーザー中間テーブル
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
