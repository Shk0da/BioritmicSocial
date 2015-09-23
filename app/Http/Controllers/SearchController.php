<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends MainController
{

    public function search(Request $request)
    {
        $view = $this->view;
        $user = $this->getUser();
        $query = $request->input('query');

        $result = User::where('id', '<>', $user->id)->where('name', 'LIKE', "%{$query}%")->get();

        $view->with('content', view('search.result')
            ->with('user', $user)
            ->with('result', $result));
        return $view;
    }
}