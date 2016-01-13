<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;


class MessageController extends MainController
{
    public function main()
    {
        return $this->index();
    }

    public function index()
    {
        $view = $this->view;
        $view->with('content', view('layout.message')
            ->with('user', $this->getUser())
        );

        return $view;
    }

    public function create()
    {
        //
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
