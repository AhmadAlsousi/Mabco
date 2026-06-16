<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Color;

class CartItem extends Model
{
    public $fillable = ['product_id','color_image_products_id','quantity','unit_price','total_price','cart_id'];
     public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    public function Cart()
    {
         return $this->belongsTo(Cart::class);
    }
    public function colorImageProduct()
{
    return $this->belongsTo(
        ColorImageProduct::class,
        'color_image_products_id',
        'id'
    );
}

}
