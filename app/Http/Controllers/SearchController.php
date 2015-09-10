<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends MainController
{

    public function search(Request $request)
    {
        $view = $this->view;
        $this->user = Auth::user();
        $query = $request->input('query');

        $result = User::where('name', 'LIKE', "%{$query}%")->get();

        $view->with('content', view('search.result')
            ->with('user', $this->getUser())
            ->with('result', $result));
        return $view;
    }
}