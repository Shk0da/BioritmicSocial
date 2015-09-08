<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;

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
