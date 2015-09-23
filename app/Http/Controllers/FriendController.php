<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;

class FriendController extends MainController
{

    public function add(User $user)
    {
        $this->checkSelfUser($user);

        if ($this->getUser()->hasFriendRequestReceived($user)) {
            $this->accept($user);
        }

        $this->getUser()->addFriend($user);
        return redirect()->back();
    }

    public function removeRequest(User $user)
    {
        $this->checkSelfUser($user);
        $this->getUser()->removeRequestToFriend($user);
        return redirect()->back();
    }

    public function accept(User $user)
    {
        $this->checkSelfUser($user);
        $this->getUser()->acceptFriendRequest($user);
        return redirect()->back();
    }

    public function remove(User $user)
    {
        $this->checkSelfUser($user);
        $this->getUser()->removeFriend($user);
        $this->getUser()->removeRequestToFriend($user);
        return redirect()->back();
    }

    protected function checkSelfUser(User $user)
    {
        if ($this->getUser()->id == $user->id)
            return redirect()->back();
    }
}
