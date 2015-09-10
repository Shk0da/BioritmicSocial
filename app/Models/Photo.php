<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';

    protected $fillable = [
        'user_id',
        'tag',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
