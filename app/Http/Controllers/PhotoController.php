<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;

class PhotoController extends MainController
{
    protected $albums = [
        'upload' => [
            'id' => 'upload',
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
                'id' => $album->id,
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

    public function addPhoto(Request $request)
    {
        $userId = $this->getUser()->id;
        $file = $request->file('image');
        $path = 'public/image/album/'.$userId.'/';
        $fileName = md5_file($file->getRealPath());
        $file->move($path, $fileName);

        $photo = new Photo();
        $photo->user_id = $userId;
        $photo->tag = 'photo';
        $photo->album_id = $request->get('album');
        $photo->path = $path.$fileName;
        $photo->save();

        return redirect()->back();
    }
}
