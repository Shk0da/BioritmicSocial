<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';

    protected $fillable = [
        'user_id',
        'path',
        'tag',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function album()
    {
        return $this->belongsTo('App\Models\Album');
    }

    public function getUrl()
    {
        return url($this->path);
    }
}
