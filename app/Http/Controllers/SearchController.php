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

        $name = $request->input('name');
        $location = $request->input('location');
        $ideal = $request->input('ideal');
        $zodiac = $request->input('zodiac');
        $rhythms = [];
        $form = [];

        $filters = BiorhythmController::instance()->getBiorhythms();
        $filter_names = array_keys($filters);

        foreach ($filter_names as $rhythm) {
            if ($request->input($rhythm)) {
                $rhythms[] = $rhythm;
                $form[$rhythm] = 'checked';
            }
        }

        $result = User::where('id', '<>', $user->id);

        if ($ideal) {
            $location = $user->profile->location;
            $result->whereIn('id', $this->findIdealPartner($result));
            $result->whereIn('id', $this->findByLocation($location));
            $form['location'] = $location;
            foreach ($filter_names as $rhythm) {
                    $form[$rhythm] = 'checked';
            }
        }

        if ($location) {
            $result->whereIn('id', $this->findByLocation($location));
            $form['location'] = $location;
        }

        if (count($rhythms))
            $result->whereIn('id', $this->findIdealPartner($result, $rhythms));

        if ($zodiac) {
            $result->whereIn('id', $this->findIdealHoro($result));
            $form['zodiac'] = 'checked';
        }

        $result->where('name', 'LIKE', "%{$name}%");

        $view->with('content', view('search.result')
            ->with('user', $user)
            ->with('filters', $filters)
            ->with('form', $form)
            ->with('result', $result->get()));
        return $view;
    }

    protected function findIdealPartner($result, $rhythms = [])
    {
        $authUser = $this->getUser();
        $users = $result->take(1000)->get();
        $find = [0];

        foreach ($users as $user) {
            $compare = BiorhythmController::instance()->boolCompare($user, $authUser, $rhythms);
            if ($compare)
                $find[] = $user->id;
        }

        return $find;
    }

    protected function findIdealHoro($result)
    {
        $authUser = $this->getUser();
        $users = $result->take(1000)->get();
        $find = [0];

        foreach ($users as $user) {
            $compare = BiorhythmController::instance()->horoCompare($user, $authUser);
            if ($compare)
                $find[] = $user->id;
        }

        return $find;
    }

    protected function findByLocation($location)
    {
        $users = User::all();
        $find = [0];

        foreach ($users as $user) {
            if ($user->profile->location == $location)
                $find[] = $user->id;
        }

        return $find;
    }
}