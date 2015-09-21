<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends MainController
{

    public function add(User $user)
    {
        $user = User::where('id', $user->id)->first();

        Auth::user()->addFriend($user);

        return redirect()->back();

    }

    public function accept(User $user)
    {
        $user->acceptFriend();
    }
}
