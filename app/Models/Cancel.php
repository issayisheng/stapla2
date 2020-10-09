<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model; // uuid

class Cancel extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $guarded = [];

    public function calendars()
    {
        return $this->belongsTo('App\Models\Calendar', 'calendar_id', 'id');
    }
}
