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
                ->with('user', $this->getUser())
                ->with('meta', $this->getMeta());
        } else {
            $view = view('auth.auth')
                ->with('meta', $this->getMeta());
        }

        return $view;
    }

    public function getMeta()
    {
        $meta = [
            'title' => 'Bioritmic',
            'description' => 'Новый подход к знакомству!',
            'keywords' => 'знакомства, онлайн',
        ];

        return $meta;
    }

    public function getUser(){
        return $this->user;
    }
}
