<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model TelegramChat
 */
class TelegramChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'chat_id',
        'username',
        'first_name',
        'last_name',
    ];
}
