<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\User;
use Storage;
use Illuminate\Http\Request;

class ProfileController extends MainController
{

    public function saveImage(Request $request)
    {
        $userId = $this->getUser()->id;
        $file = $request->file('image');
        $path = 'public/image/profile_image/'.$userId.'/';
        $fileName = md5_file($file->getRealPath());
        $file->move($path, $fileName);

        $photo = new Photo();
        $photo->user_id = $userId;
        $photo->tag = 'avatar';
        $photo->path = $path.$fileName;
        $photo->save();

        $user = User::find($userId);
        $user->profile->image_profile = $photo->id;
        $user->profile->save();

        return redirect()->route('edit');
    }

}