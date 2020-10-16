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

    // ユーザーテーブル
    public function users()
    {
        return $this->belongsTo('App\User', 'owner_id', 'id');
    }

    // ユーザー中間
    public function userGyms()
    {
        return $this->hasMany('App\User', 'gym_id', 'id');
    }

    // カレンダーテーブル
    public function calendars()
    {
        return $this->hasMany('App\Models\Calendar');
    }
}
