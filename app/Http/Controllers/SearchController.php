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

        $d = ($lived_days - $lived_days2);
        $fiz = (int)floor( ( ($d/$biorhythms['fiz']['cycle']) - floor($d/$biorhythms['fiz']['cycle']) ) * 100 );
        $emo = (int)floor(((($d/$biorhythms['emo']['cycle']) - floor($d/$biorhythms['emo']['cycle']))) * 100);
        $int = (int)floor(((($d/$biorhythms['int']['cycle']) - floor($d/$biorhythms['int']['cycle']))) * 100);


        $k = [
            0  =>   100,
            1  =>   100,
            2  =>   99,
            3  => 	99,
            4  => 	98,
            5  => 	97,
            6  =>	96,
            7  => 	95,
            8  => 	94,
            9  => 	92,
            10  => 	90,
            11 =>	88,
            12 =>	85,
            13 => 	83,
            14 => 	80,
            15 => 	78,
            16 => 	76,
            17 => 	74,
            18 => 	70,
            19 => 	66,
            20 => 	62,
            21 => 	60,
            22 => 	57,
            23 => 	55,
            24 => 	53,
            25 => 	50,
            26 => 	46,
            27 => 	43,
            28 => 	40,
            29 => 	36,
            30 => 	33,
            31 => 	30,
            32 => 	27,
            33 => 	25,
            34 => 	22,
            35 => 	20,
            36 => 	17,
            37 => 	15,
            38 => 	12,
            39 => 	10,
            40 => 	8,
            41 => 	7,
            42 => 	6,
            43 => 	4,
            44 => 	3,
            45 => 	2,
            46 => 	1,
            47 => 	0.7,
            48 => 	0.5,
            49 => 	0,
            50 => 	0,
            51 => 	0.5,
            53 => 	1,
            54 => 	2,
            55 => 	3,
            56 => 	4,
            59 => 	8,
            62 => 	15,
            63 => 	17,
            65 =>   22,
            66 => 	25,
            68 => 	30,
            70 => 	36,
            71 => 	40,
            72 => 	43,
            74 => 	48,
            75 => 	50,
            77 =>	57,
            78 =>   60,
            81 => 	70,
            82 => 	73,
            83 => 	76,
            84 => 	78,
            85 => 	80,
            86 => 	83,
            87 => 	85,
            88 => 	88,
            90 => 	92,
            92 => 	95,
            93 => 	96,
            95 => 	98,
            96 => 	99,
        ];

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
                $k[$fiz],
                $k[$emo],
                $k[$int],
            ],
        ];

        dd($res);
        return $users;
    }
}