<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;  // uuid
use Illuminate\Database\Eloquent\SoftDeletes;

class Gym extends Model
{
    protected $table = 'gyms';

    protected $guarded = [];

    // 論理削除有効化
    use SoftDeletes;

    public function userGyms()
    {
        return $this->hasMany('App\User', 'gym_id', 'id');
    }

    public function calendars()
    {
        return $this->hasMany('App\Models\Calendar');
    }
}
