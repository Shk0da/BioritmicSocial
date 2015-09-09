<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;

class MainController extends Controller
{
    protected $user;

    public function index()
    {
        $this->user = Auth::user();

        if (Auth::check()) {
            $view = view('layout.home');
            $view->with('user', $this->user);
        } else {
            $view = view('auth.auth');
        }

        return $view;
    }
}
