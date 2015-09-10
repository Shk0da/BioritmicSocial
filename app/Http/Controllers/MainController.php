<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;

class MainController extends Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = view('main')
            ->with('meta', $this->getMeta());
    }

    public function index()
    {
        $view = $this->view;

        if (Auth::check()) {
            $view->with('content', view('layout.home')->with('user', $this->getUser()));
        } else {
            $view->with('content', view('auth.auth'));
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
        return Auth::user();
    }
}
