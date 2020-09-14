<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Gym;

class Calendar extends Model
{
    protected $table = 'calendars';

    protected $guarded = [''];

    public function gyms()
    {
        return $this->belongsTo(Gym::class);
    }
}
