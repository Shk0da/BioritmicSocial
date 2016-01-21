<?php

namespace App\Http\Controllers;

use App\Models\Profile;
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
        $man = $request->input('man');
        $woman = $request->input('woman');
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

        if ($location) {
            $result->whereIn('id', $this->findByLocation($location));
            $form['location'] = $location;
        }

        if ($man) {
            $result->whereIn('id', $this->findByGender('man'));
            $form['man'] = 'checked';
        }

        if ($woman) {
            $result->whereIn('id', $this->findByGender('woman'));
            $form['woman'] = 'checked';
        }

        if ($user->profile->birthday) {
            if ($ideal) {
                $location = $user->profile->location;
                $result->whereIn('id', $this->findIdealPartner($result));
                $result->whereIn('id', $this->findByLocation($location));
                $form['location'] = $location;
                foreach ($filter_names as $rhythm) {
                    $form[$rhythm] = 'checked';
                }

                if ($user->profile->gender == 1) {
                    $result->whereIn('id', $this->findByGender('woman'));
                    $form['woman'] = 'checked';
                }

                if ($user->profile->gender == 0) {
                    $result->whereIn('id', $this->findByGender('man'));
                    $form['man'] = 'checked';
                }
            }

            if (count($rhythms))
                $result->whereIn('id', $this->findIdealPartner($result, $rhythms));

            if ($zodiac) {
                $result->whereIn('id', $this->findIdealHoro($result));
                $form['zodiac'] = 'checked';
            }
        }

        $result->where('name', 'LIKE', "%{$name}%");
        $result = $result->paginate(15);

        $view->with('content', view('search.result')
            ->with('user', $user)
            ->with('filters', $filters)
            ->with('form', $form)
            ->with('result', $result));
        return $view;
    }

    protected function findIdealPartner($result, $rhythms = [])
    {
        $authUser = $this->getUser();
        $users = $result->take(1000)->get();
        $find = [0];

        foreach ($users as $user) {

            if (!$user->profile->birthday)
                continue;

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

            if (!$user->profile->birthday)
                continue;

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
            if ($user->profile->location && $user->profile->location == $location) {
                $find[] = $user->id;
            }
        }

        return $find;
    }

    protected function findByGender($gender)
    {
        $genders = ['woman' => 0, 'man' => 1];
        $users = User::all();
        $find = [0];

        foreach ($users as $user) {
            if (isset($user->profile->gender) && $user->profile->gender == $genders[$gender]) {
                $find[] = $user->id;
            }
        }

        return $find;
    }
}