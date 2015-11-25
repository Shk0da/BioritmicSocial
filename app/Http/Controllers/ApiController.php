<?php

namespace App\Http\Controllers;

use App\Http\Requests;

class ApiController extends MainController
{

    public function main(Requests $requests)
    {
        dd($requests);
    }

}
