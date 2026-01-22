<?php

namespace App\Models\Burra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BurraCategory extends Model
{
    use HasFactory;

    protected $table = 'burra_category';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
    ];

    public function products()
    {
        return $this->hasMany(BurraProduct::class, 'category_id');
    }
}
