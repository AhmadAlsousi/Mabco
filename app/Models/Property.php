<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\ColorImageProduct;

class Property extends Model
{
    public $fillable = ['name', 'description', 'product_id', 'color_image_products_id'];
    public function product(){
        return $this->belongsTo(Product::class);
    }
     public function color_image_products(){
        return $this->hasMany(ColorImageProduct::class);
    }

}
