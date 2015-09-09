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
        return view('auth.login')->with('meta', $this->get_meta());
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

        $info = 'Вы успешно зарегистрировались!';
        $this->authenticate($email, $password, true);
        return redirect()->intended()->with('info', $info);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->has('remember');

        $info = 'Добро пожаловать!';
        $this->authenticate($email, $password, $remember);
        if (!Auth::check()) {
            return redirect()->back()->with('info', 'Вам не удалось войти');
        }
        return redirect()->intended()->with('info', $info);
    }

    public function authenticate($email, $password, $remember)
    {
        Auth::attempt(['email' => $email, 'password' => $password], $remember);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->intended();
    }

}
