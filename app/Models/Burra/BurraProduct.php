<?php

namespace App\Models\Burra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BurraProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'variable',
        'price',
        'category_id',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(BurraCategory::class, 'category_id');
    }
}
