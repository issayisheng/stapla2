<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model; // uuid

class CalendarUser extends Model
{
    // テーブル名を定義する。
    protected $table = 'calendar_user';
}
