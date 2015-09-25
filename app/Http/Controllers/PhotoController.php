<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

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

    public function albumCreate(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
        ]);

        $name = $request->get('name');

    }
}
