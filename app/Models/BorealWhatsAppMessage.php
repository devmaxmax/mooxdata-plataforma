<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorealWhatsAppMessage extends Model
{
    use HasFactory;

    protected $table = 'boreal_whats_app_messages';

    protected $fillable = [
        'phone_number',
        'message',
        'type',
        'wp_id',
        'status',
    ];
}
