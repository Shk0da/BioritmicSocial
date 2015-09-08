<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;

class MainController extends Controller
{

    protected $user;

    public function boot()
    {
        //Auth::loginUsingId(1);
    }

    public function index()
    {
        $this->user = Auth::user();

        if (Auth::check()) {
            $view = view('home');
            $view->with('user', $this->user->id);
        } else {
            $view = view('auth');
        }

        return $view;
    }
}
