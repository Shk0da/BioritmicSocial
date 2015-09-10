<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends MainController
{

    public function search(Request $request)
    {
        $this->user = Auth::user();
        $query = $request->input('query');

        $result = User::where('name', 'LIKE', "%{$query}%")->get();

        return view('search.result')
            ->with('user', $this->getUser())
            ->with('meta', $this->getMeta())
            ->with('result', $result);
    }
}