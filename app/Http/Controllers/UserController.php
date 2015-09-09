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
        $view = view('layout.profile')
            ->with('user', $user)
            ->with('meta', $this->get_meta());
        return $view;
    }

    public function edit(){
        $user = $this->user;
    }

    public function update(Request $request, $id){}

    public function destroy($id){}
}
