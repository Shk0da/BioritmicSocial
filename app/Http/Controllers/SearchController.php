<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends MainController
{

    public function search(Request $request)
    {
        $view = $this->view;
        $ids = [0];

        $user = $this->getUser();
        $name = $request->input('name');
        $location = $request->input('location');
        $country = $request->input('country');
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

        if (!$user->profile->birthday) {
            $view->with('content', view('search.nothing')
                ->with('user', $user)
                ->with('filters', $filters)
            );

            return $view;
        }

        $result = User::where('id', '<>', $user->id);
        $profiles = DB::table('users')
            ->join('profiles', 'users.id', '=', 'profiles.user_id')
            ->select(
                'users.id',
                'users.name',
                'profiles.birthday',
                'profiles.location',
                'profiles.gender',
                'profiles.zodiac'
            );

        if (trim($name) != '') {
            $profiles->where('name', 'LIKE', "%{$name}%");
        }

        if ($ideal && $user->profile->birthday) {

            if ($location = $user->profile->location) {
                $profiles->where('location', $location);
                $form['location'] = $location;
            }

            if ($user->profile->gender == 1) {
                $profiles->where('gender', 0);
                $form['woman'] = 'checked';
            }

            if ($user->profile->gender == 0) {
                $profiles->where('gender', 1);
                $form['man'] = 'checked';
            }

            foreach ($profiles->get() as $profile) {
                $ids[] = $profile->id;
            }
            $result->whereIn('id', $ids);

            $result->whereIn('id', $this->findIdealPartner($result));
            foreach ($filter_names as $rhythm) {
                $form[$rhythm] = 'checked';
            }
        } else {

            if ($country) {
                $profiles->whereIn('location', array_keys($user->getCityList($country)));
                $form['country'] = $country;
            }

            if ($location) {
                $profiles->where('location', $location);
                $form['location'] = $location;
            }

            if ($man && $woman) {
                $profiles->whereIn('gender', [0, 1]);
                $form['man'] = 'checked';
                $form['woman'] = 'checked';
            } elseif ($man) {
                $profiles->where('gender', 1);
                $form['man'] = 'checked';
            } elseif ($woman) {
                $profiles->where('gender', 0);
                $form['woman'] = 'checked';
            }

            $profiles->take(15000);

            foreach ($profiles->get() as $profile) {
                $ids[] = $profile->id;
            }
            $result->whereIn('id', $ids);

            if ($user->profile->birthday) {

                if (count($rhythms)) {
                    $result->whereIn('id', $this->findIdealPartner($result, $rhythms));
                }

                if ($zodiac) {
                    $result->whereIn('id', $this->findIdealHoro($result));
                    $form['zodiac'] = 'checked';
                }
            }
        }

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
}
