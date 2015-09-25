<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoController extends MainController
{
    protected $albums = [
        'upload' => [
            'name' => 'Загруженные фотографии',
            'data' => [],
        ],
    ];

    public function __construct()
    {
        parent::__construct();
        $uploadPhotos = $this->getUser()->photo()->where('tag', 'upload')->get();
        $this->albums['upload']['data'] = $uploadPhotos;

        $userAlbums = $this->getUser()->album()->get();
        foreach ($userAlbums as $album) {
            $this->albums[$album->id]  = [
                'name' => $album->name,
                'data' => $this->getUser()->photo()->where('album_id', $album->id)->get(),
            ];
        }

    }

    public function edit()
    {
        $view = $this->view;

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

        $this->getUser()->album()->create([
            'name' => $name,
        ]);

        return redirect()->back();

    }

    public function albumShow($albumId)
    {
        $view = $this->view;

        $view->with('content', view('photo.show')
            ->with('user', $this->getUser())
            ->with('album', $this->albums[$albumId])
        );
        return $view;
    }
}
