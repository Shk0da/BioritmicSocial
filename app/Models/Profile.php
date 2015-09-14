<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = [
        'user_id',
        'birthday',
        'image_profile',
        'location',
        'status',
        'about',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}