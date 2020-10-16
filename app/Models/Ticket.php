<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;  // UUID

class Ticket extends Model
{
    protected $guarded = [''];

    // ユーザーテーブル
    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    // 購入履歴テーブル
    public function histories()
    {
        return $this->hasMany('App\Models\History');
    }
}
