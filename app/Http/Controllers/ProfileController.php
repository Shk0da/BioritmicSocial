<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProfileController extends MainController
{

    public function saveImage(Request $request)
    {
        $this->validate($request, [
            'avatar_file' => 'mimes:jpeg,png',
        ]);

        $data = json_decode(stripslashes($request->get('avatar_data')));

        $userId = $this->getUser()->id;
        $file = $request->file('avatar_file');
        $path = 'storage/profile_image/'.$userId.'/';
        $fileName = md5_file($file->getRealPath());
        $file->move($path, $fileName);
        $original = File::get($path.$fileName);
        File::put($path.$fileName.'_original', $original);
        PhotoController::crop($path.$fileName, $data->x, $data->y, $data->height, $data->width);

        $photo = new Photo();
        $photo->user_id = $userId;
        $photo->tag = 'avatar';
        $photo->path = $path.$fileName;
        $photo->save();

        $user = User::find($userId);
        $user->profile->image_profile = $photo->id;
        $user->profile->save();

        return redirect()->back();
    }

    public function saveBackground(Request $request)
    {
        $userId = $this->getUser()->id;
        $file = $request->file('background');
        $path = 'storage/background/'.$userId.'/';
        $fileName = md5_file($file->getRealPath());
        $file->move($path, $fileName);

        $photo = new Photo();
        $photo->user_id = $userId;
        $photo->tag = 'background';
        $photo->path = $path.$fileName;
        $photo->save();

        $user = User::find($userId);
        $user->profile->background = $photo->id;
        $user->profile->save();

        return redirect()->route('edit');
    }

}