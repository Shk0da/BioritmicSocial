<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;

class ProfileController extends MainController
{

    public function saveImage(Request $request)
    {
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $tmpFilePath = '/public/upload/';
            $tmpFileName = time() . '-' . $file->getClientOriginalName();
            $file = $file->move(public_path() . $tmpFilePath, $tmpFileName);
            $path = $tmpFilePath . $tmpFileName;
            return response()->json(array('path'=> $path), 200);
        } else {
            return response()->json(false, 200);
        }
    }

}