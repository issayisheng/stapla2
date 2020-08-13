<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymClose extends Model
{
    protected $table = 'gym_closes';

    protected $fillable = [
        'gym_id', 'closing_stated', 'closing_ended'
    ];

    public function gym()
    {
        return $this->belongsTo('App\Models\Gym', 'gym_id', 'id');
    }
}
