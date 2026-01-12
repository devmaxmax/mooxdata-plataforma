<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RagData extends Model
{
    use HasFactory;

    protected $table = 'rag_data';

    protected $fillable = [
        'topic',
        'content',
        'is_active',
    ];
}
