<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    public $fillable = [
        'quantity',
        'unit_price',
        'total_price',
        'product_id',
        'color_id',
        'order_id'
    ];
     public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    public function Order()
    {
         return $this->belongsTo(Order::class);
    }
}
