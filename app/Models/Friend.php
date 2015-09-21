<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'friends';

    protected $fillable = [
        'user_id',
        'friend_id',
        'accepted',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
