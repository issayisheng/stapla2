<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model; // uuid

class HistoryCancel extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    // Historyテーブル
    public function calendars()
    {
        return $this->belongsTo('App\Models\History', 'history_id', 'id');
    }
}
