<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'from',
        'to',
        'text',
        'created_at',
    ];

    protected $times = [
        'time_1'        => 'Меньше минуты назад',
        'time_2'        => ' минут(ы) назад',
        'time_3'        => ' часа(ов) назад',
        'time_4'        => 'Сегодня в ',
        'time_5'        => 'Вчера в ',
        'time_month'    => [
            'Января',
            'Феваряля',
            'Марта',
            'Апреля',
            'Мая',
            'Июня',
            'Июля',
            'Августа',
            'Сентября',
            'Октября',
            'Ноября',
            'Декабря'
        ],
    ];

    public function getFromUser()
    {
        return User::find($this->from);
    }

    public function getToUser()
    {
        return User::find($this->to);
    }

    public function getMessage()
    {
        $message = mb_strcut($this->text, 0, 100);
        return $message;
    }

    public function getText()
    {
        $message = $this->text;
        return $message;
    }

    public function getTime()
    {
        $timestamp = strtotime($this->created_at);
        $dif = time() - $timestamp;
        $month = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');

        switch( true ) {

            case $dif < 60 : // меньше минуты
                return $this->times['time_1'];

            case $dif < 3600 : // N минут назад
                return (int)($dif / 60) . $this->times['time_2'];

            case date('Ymd') == date('Ymd', $timestamp) : // Сегодня в H:i
                return $this->times['time_4'] . date('H:i', $timestamp);

            case date('Ymd') == date('Ymd', $timestamp+3600*24) : // Вчера в H:i
                return $this->times['time_5'] . date('H:i', $timestamp);

            case date('Y') == date('Y', $timestamp) :
                return str_replace( $month, $this->times['time_month'], date('d M H:i', $timestamp) );

            default:
                return str_replace( $month, $this->times['time_month'], date('d M Y H:i', $timestamp) );
        }

    }


}
