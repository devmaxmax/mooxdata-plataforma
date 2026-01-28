<?php

namespace App\Models\Burra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BurraOrder extends Model
{
    use HasFactory;

    protected $fillable = ['table_number', 'status', 'total', 'customer_name', 'customer_address', 'customer_phone', 'customer_note', 'payment_method'];

    public function items()
    {
        return $this->hasMany(BurraOrderItem::class, 'order_id');
    }
}
