<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'location',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    public function photo()
    {
        return $this->hasMany('App\Models\Photo');
    }

    public function getName()
    {
        return $this->name ?: null;
    }

    public function getLocation()
    {
        return $this->profile->location ?: null;
    }

    public function getProfileLink()
    {
        return "/id{$this->id}";
    }

    public function getImageProfile()
    {
        return '/public/img/avatar-fat.jpg';
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getStatus()
    {
        return $this->profile->status ?: null;
    }

    public function getBirthday()
    {
        return array_map('intval', explode("-", $this->profile->birthday)) ?: null;
    }

    public function getStringBirthday()
    {
        return implode('.', array_reverse(explode("-", $this->profile->birthday))) ?: null;
    }

    public function getAbout()
    {
        return $this->profile->about ?: null;
    }

    public function getZodiac()
    {
        $data = $this->profile->birthday;
        $day = str_replace("-", "", substr($data, 5));
        $zodiak = array('ot' => array('0120', '0219', '0321', '0421', '0521', '0622', '0723', '0823', '0923', '1024', '1123', '1222', '0101'),
            'do' => array('0218', '0320', '0420', '0520', '0621', '0722', '0822', '0922', '1023', '1122', '1221', '1231', '0119'),
            'zn' => array('Водолей', 'Рыбы', 'Овен', 'Телец', 'Близнец', 'Рак', 'Лев', 'Дева', 'Весы', 'Скорпион', 'Стрелец', 'Козерог', 'Козерог'));
        $i = 0;
        while (empty($znak) && ($i < 13)) {
            $znak = (($zodiak['ot'][$i] <= $day) && ($zodiak['do'][$i] >= $day)) ? $zodiak['zn'][$i] : null;
            ++$i;
        }

        return $znak;
    }

    public function getChinaZodiac()
    {
        $data = $this->profile->birthday;
        $year = str_replace("-", "", substr($data, 0, 4));
        $animals = ['Крысы', 'Быка', 'Тигра', 'Кролика', 'Дракона', 'Змеи', 'Лошади', 'Овцы', 'Обезьяны', 'Петуха', 'Собаки', 'Кабана'];

        $count = 1;
        for ($i = 1900; $i < $year; $i++) {
            $zodiac = $animals[$count++];
            if ($count == 12) $count = 0;
        }

        return $zodiac;
    }
}
