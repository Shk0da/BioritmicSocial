<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Models\User;
use App\Http\Requests;

class AuthController extends MainController
{
    public function index()
    {
        //
    }


    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
        ]);

        $this->authenticate($email, $password);
    }

    public function authenticate($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()
                ->intended('main')
                ->with('info', 'Вы успешно зарегистрировались!');
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
