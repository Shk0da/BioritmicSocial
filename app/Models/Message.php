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
}
