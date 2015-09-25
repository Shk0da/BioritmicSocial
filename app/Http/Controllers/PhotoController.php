<?php

namespace App\Http\Controllers;

class PhotoController extends MainController
{
    public function edit()
    {
        $view = $this->view;
        $view->with('content', view('photo.edit')->with('user', $this->getUser()));
        return $view;
    }
}
