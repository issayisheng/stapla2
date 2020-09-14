<?php

namespace App\Models;

use App\User;
use App\Models\Ticket;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;  // UUID

class History extends Model
{
    protected $guarded = [''];
    protected $dates = ['seen_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function tickets()
    {
        return $this->belongsTo(Ticket::class);
    }
}
