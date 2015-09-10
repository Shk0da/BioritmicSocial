<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends MainController
{

    public function show(User $user)
    {
        $view = view('layout.profile')
            ->with('user', $user)
            ->with('meta', $this->getMeta());
        return $view;
    }

    public function edit(){}

    public function destroy(){}
}
