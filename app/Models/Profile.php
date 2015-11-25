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

    public function gatLocation()
    {
        $location = Location::where('id', $this->location)
            ->get(['city', 'country'])
            ->toArray();

        if (count($location)){
            $location = $location[0];
        } else {
            $location = ['city' => null, 'country' => null];
        }


        return $location;
    }
}
