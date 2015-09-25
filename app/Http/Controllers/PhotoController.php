<?php

namespace App\Http\Controllers;

use App\Models\Photo;

class PhotoController extends MainController
{
    protected $albums = [
        'upload' => [
            'name' => 'Загруженные фотографии',
            'data' => [],
        ],
    ];

    public function edit()
    {
        $view = $this->view;
        $photos = Photo::where('user_id', $this->getUser()->id)->get();
        $this->albums['upload']['data'] = $photos;


        $view->with('content', view('photo.edit')
            ->with('user', $this->getUser())
            ->with('albums', $this->albums)
        );
        return $view;
    }
}
