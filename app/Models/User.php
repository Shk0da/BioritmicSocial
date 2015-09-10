<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'location',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function getName()
    {
        return $this->name ?: null;
    }

    public function getLocation()
    {
        return $this->location ?: null;
    }

    public function getProfileLink()
    {
        return "/id{$this->id}";
    }

    public function getImageProfile()
    {
        return '/public/img/avatar-fat.jpg';
    }
}
