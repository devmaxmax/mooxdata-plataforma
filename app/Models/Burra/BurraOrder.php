<?php

namespace App\Models\Burra;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BurraOrder extends Model
{
    use HasFactory;

    protected $fillable = ['table_number', 'status', 'total'];

    public function items()
    {
        return $this->hasMany(BurraOrderItem::class, 'order_id');
    }
}
