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
    ];

    // ジムテーブル
    public function gyms()
    {
        return $this->belongsTo('App\Models\Gym', 'gym_id', 'id');
    }

    // キャンセルテーブル
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
