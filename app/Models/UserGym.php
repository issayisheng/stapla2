<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGym extends Model
{
    protected $table = 'user_gyms';

    protected $fillable = [
        'user_id', 'gym_id', 'status'
    ];

    public function gym()
    {
        return $this->belongsTo('App\Models\Gym', 'gym_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
