<?php

namespace App\Models\Burra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BurraOrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'product_name', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(BurraOrder::class, 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(BurraProduct::class, 'product_id');
    }
}
