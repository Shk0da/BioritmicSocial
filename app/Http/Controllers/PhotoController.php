<?php

namespace App\Http\Controllers;

use App\Models\Photo;
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
            $this->albums[$album->id] = [
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
        $path = 'storage/album/' . $userId . '/';
        $fileName = md5_file($file->getRealPath());
        $file->move($path, $fileName);

        $photo = new Photo();
        $photo->user_id = $userId;
        $photo->tag = 'photo';
        $photo->album_id = $request->get('album');
        $photo->path = $path . $fileName;
        $photo->save();

        return redirect()->back();
    }

    public static function crop($image, $x_o, $y_o, $w_o, $h_o)
    {
        if (($x_o < 0) || ($y_o < 0) || ($w_o < 0) || ($h_o < 0))
            return false;

        list($w_i, $h_i, $type) = getimagesize($image);
        $types = ['', 'gif', 'jpeg', 'png'];
        $ext = $types[$type];

        if (!$ext)
            return false;

        $func = 'imagecreatefrom' . $ext;
        $img_i = $func($image);

        if ($x_o + $w_o > $w_i)
            $w_o = $w_i - $x_o;

        if ($y_o + $h_o > $h_i)
            $h_o = $h_i - $y_o;

        $img_o = imagecreatetruecolor($w_o, $h_o);

        if ($ext == 'png') {
            imagefill($img_o, 0, 0, imagecolorallocatealpha($img_o, 0, 0, 0, 127));
            imagesavealpha($img_o, true);
        }

        imagecopy($img_o, $img_i, 0, 0, $x_o, $y_o, $w_o, $h_o);
        $func = 'image' . $ext;
        return $func($img_o, $image);
    }
}
