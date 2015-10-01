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
        $users = User::find(1);
        /*
            Физический — 23,6884 суток — соответствует нижней чакре Муладхара
            Эмоциональный — 28,426125 суток — вторая чакра Свадхистана
            Интеллектуальный — 33,163812 суток — третья чакра Манипура
            Сердечный — 37,901499 суток — четвертая чакра Анахата
            Творческий — 42,6392 суток — пятая чакра Вишудха
            Интуитивный — 47,3769 суток — шестая чакра Аджна
            Высшая чакра — 52,1146 суток — седьмая чакра Сахасрара
         */

        $biorhythms = [
            'fiz' => [
                'name'  => 'Физический',
                'cycle' => 23.6884,
            ],
            'emo' => [
                'name'  => 'Эмоциональный',
                'cycle' => 28.426125,
            ],
            'int' => [
                'name'  => 'Интелектуальный',
                'cycle' => 33.163812,
            ]
        ];


        $lived_days = (new \DateTime($this->getUser()->profile->birthday))
            ->diff(new \DateTime())
            ->days;

        $lived_days2 = (new \DateTime($users->profile->birthday))
            ->diff(new \DateTime())
            ->days;

        $fiz1 = (sin(2*pi()*$lived_days/$biorhythms['fiz']['cycle']))*100;
        $emo1 = (sin(2*pi()*$lived_days/$biorhythms['emo']['cycle']))*100;
        $int1 = (sin(2*pi()*$lived_days/$biorhythms['int']['cycle']))*100;

        $fiz2 = (sin(2*pi()*$lived_days2/$biorhythms['fiz']['cycle']))*100;
        $emo2 = (sin(2*pi()*$lived_days2/$biorhythms['emo']['cycle']))*100;
        $int2 = (sin(2*pi()*$lived_days2/$biorhythms['int']['cycle']))*100;

        $d = $lived_days - $lived_days2;
        $k = ((abs($d/$biorhythms['fiz']['cycle']) - ($d/$biorhythms['fiz']['cycle']))) * 100;
        $res = [
            1 => [
                $fiz1,
                $emo1,
                $int1,
            ],
            2 => [
                $fiz2,
                $emo2,
                $int2,
            ],
            3 => [
                $k,
            ],
        ];

        dd($res);
        return $users;
    }
}