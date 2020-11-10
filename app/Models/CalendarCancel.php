<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model; // uuid

class CalendarCancel extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    // カレンダーテーブル
    public function calendars()
    {
        return $this->belongsTo('App\Models\Calendar', 'calendar_id', 'id');
    }
}
