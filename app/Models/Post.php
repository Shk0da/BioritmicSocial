<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Auth;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'parent_id',
        'body',
        'attach',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likes');
    }

    public function getMessage()
    {
        return $this->body;
    }

    public function getTimeSend()
    {
        return $this->created_at->diffForHumans();
    }

    public function scopeNotComment($query)
    {
        return $query->whereNull('parent_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Post', 'parent_id');
    }

}
