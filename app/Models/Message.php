<?php

namespace App\Models;

class Message extends MainModel
{
    protected $table = 'messages';

    protected $fillable = [
        'from',
        'to',
        'text',
        'created_at',
        'dialog',
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
}

