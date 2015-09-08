<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends MainController
{

    public function index(){}

    public function create(){}

    public function store(Request $request){}

    public function show(User $user)
    {
        $view = view('profile')
            ->with('user', $user->id);
        return $view;
    }

    public function edit($id){}

    public function update(Request $request, $id){}

    public function destroy($id){}
}
