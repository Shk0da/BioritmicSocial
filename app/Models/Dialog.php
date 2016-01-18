<?php

namespace App\Models;

class Dialog extends MainModel
{
    protected $table = 'dialogs';

    protected $fillable = [
        'from',
        'to',
    ];

    public static function getOrCreate($from, $to)
    {
        $dialog = self::
            where(function ($query) use ($from, $to) {
                $query->where('from', $from)->where('to', $to);
            })
            ->orWhere(function ($query) use ($from, $to) {
                $query->where('to', $from)->where('from', $to);
            })
            ->first();

        if (!$dialog) {
            $dialog = self::create(
                [
                    'from' => $from,
                    'to' => $to,
                ]
            );
        }

        return $dialog;
    }
}

