<?php

namespace App\Http\Controllers;

use App\Models\User;

class BiorhythmController extends MainController
{
    static protected $_instance;
    protected $biorhythms;

    public static function instance()
    {
        if (empty(static::$_instance))
            static::$_instance = new BiorhythmController();

        return self::$_instance;
    }

    public function __construct()
    {
        /*
            Физический — 23,6884 суток — соответствует нижней чакре Муладхара
            Эмоциональный — 28,426125 суток — вторая чакра Свадхистана
            Интеллектуальный — 33,163812 суток — третья чакра Манипура
            Сердечный — 37,901499 суток — четвертая чакра Анахата
            Творческий — 42,6392 суток — пятая чакра Вишудха
            Интуитивный — 47,3769 суток — шестая чакра Аджна
            Высшая чакра — 52,1146 суток — седьмая чакра Сахасрара
         */

        $this->biorhythms = [
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
    }

    public function getRitm(User $user)
    {
        $rhythms = [];

        if (!$user->profile->birthday)
            return $rhythms;

        $biorhythms = $this->biorhythms;
        $lived_days = (new \DateTime($user->profile->birthday))
            ->diff(new \DateTime())
            ->days;

        foreach($biorhythms as $biorhythm) {
            $rhythms[$biorhythm['name']] = (sin(2*pi()*$lived_days/$biorhythm['cycle']))*100;
        }

        return $rhythms;
    }

    public function compare(User $user1, User $user2, $string = null)
    {
        $compare = [];

        if (!$user1->profile->birthday || !$user2->profile->birthday)
            return $compare;

        $biorhythms = $this->biorhythms;
        $diff_lived_days = (new \DateTime($user1->profile->birthday))
            ->diff(new \DateTime($user2->profile->birthday))
            ->days;

        foreach($biorhythms as $biorhythm) {
            $rhythm = (int)floor( ( ($diff_lived_days/$biorhythm['cycle'])
                    - floor($diff_lived_days/$biorhythm['cycle']) ) * 100 );
            $compare[$biorhythm['name']] = ($rhythm > 50) ? (($rhythm-50)*2) : (-1)*(($rhythm-50)*2);
        }

        dd($compare);
        return $compare;
    }

}
