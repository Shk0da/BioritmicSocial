<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ApiController extends MainController
{

    public function main($action, Request $request)
    {
        if (method_exists($this, $action))
            return $this->$action($request);

        return 0;
    }

    public function getCityList($request = null)
    {
        if ($country = $request->input('country')) {
            $list = $this->getUser()->getCityList($country);
            return $list;
        }

        return 0;
    }

}
