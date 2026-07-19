<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBot extends Model
{
    use HasFactory;

    protected $table = 'log_bot';

    protected $fillable = [
        'user_message',
        'bot_response',
        'ip_address',
    ];
}
