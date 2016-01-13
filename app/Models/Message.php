<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'from',
        'to',
        'text',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'to');
    }
}
