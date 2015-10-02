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
        $type = $request->input('type');

        $result = User::where('id', '<>', $user->id);

        if ($type == 'ideal')
            $result->whereIn('id', $this->findIdealPartner());

        $result->where('name', 'LIKE', "%{$query}%");

        $view->with('content', view('search.result')
            ->with('user', $user)
            ->with('result', $result->get()));
        return $view;
    }

    protected function findIdealPartner()
    {
        $user = User::find(1);
        $bioritm = BiorhythmController::instance();
        $bioritm->compare($user, $this->getUser());
        return [1];
    }
}