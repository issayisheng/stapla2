<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;  // UUID
use App\Models\History;

class Ticket extends Model
{
    protected $guarded = [''];

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
