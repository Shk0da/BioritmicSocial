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

        if (Auth::check()) { view();
            $view = view('layout.home')
                ->with('user', $this->user)
                ->with('meta', $this->get_meta());
        } else {
            $view = view('auth.auth')
                ->with('meta', $this->get_meta());
        }

        return $view;
    }

    public function get_meta()
    {
        $meta = [
            'title' => 'Bioritmic',
            'description' => 'Новый подход к знакомству!',
            'keywords' => 'знакомства, онлайн',
        ];

        return $meta;
    }
}
