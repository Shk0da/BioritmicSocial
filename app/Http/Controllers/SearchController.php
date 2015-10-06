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

        if (in_array('ideal', $type)) {
            $result->whereIn('id', $this->findIdealPartner($result));
        }

        if (in_array('zodiac', $type)) {
            //$result->whereIn('id', $this->findIdealPartner($result));
        }


        $result->where('name', 'LIKE', "%{$query}%");

        $view->with('content', view('search.result')
            ->with('user', $user)
            ->with('result', $result->get()));
        return $view;
    }

    protected function findIdealPartner($result)
    {
        $authUser = $this->getUser();
        $users = $result->take(1000)->get();
        $find = [0];

        foreach ($users as $user) {
            $compare = BiorhythmController::instance()->boolCompare($user, $authUser);
            if ($compare)
                $find[] = $user->id;
        }

        return $find;
    }
}