<?php

namespace App\Models\Burra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BurraWhatsAppMessage extends Model
{
    protected $fillable = [
        'phone_number',
        'message',
        'type', // incoming, outgoing
        'wp_id',
        'status', 
    ];
}
