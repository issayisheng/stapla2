<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;  // UUID

class History extends Model
{
    protected $guarded = [''];
    protected $dates = ['seen_at'];

    // ユーザーテーブル
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    // チケットテーブル
    public function tickets()
    {
        return $this->belongsTo('App\Models\Ticket');
    }

    // キャンセルテーブル
    public function cancels()
    {
        return $this->hasMany('App\Models\HistoryCancel');
    }
}
