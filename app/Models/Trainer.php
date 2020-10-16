<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $guarded = [''];

    // ユーザーテーブル
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
