<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Offer extends Model
{
    public $fillable = ['products_id', 'discount', 'startDate', 'endDate', 'status'];

    public function products()
    {
         return $this->belongsTo(Product::class, 'products_id', 'id');
    }
    protected $casts = [
        // 'products_id' => 'array',
    ];
}
