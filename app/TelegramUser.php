<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TelegramUser extends Model
{
    protected $fillable = [
        'telegram_id',
        'habitica_id',
        'habitica_key',
    ];

    protected $hidden = [
        'habitica_key',
    ];
}
