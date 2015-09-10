<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

use Auth;
use App\Models\User;
use App\Http\Requests;

class AuthController extends MainController
{
    public function index()
    {
        $view = $this->view;

        if (Auth::check()) {
            return redirect()->intended();
        }

        $view->with('content', view('auth.login'));
        return $view;
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

        $this->authenticate($email, $password, true);
        Profile::firstOrCreate(['user_id' => Auth::user()->id]);
        return redirect()->intended();
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
        $this->authenticate($email, $password, $remember);

        if (!Auth::check()) {
            return redirect()->back();
        }

        return redirect()->intended();
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
