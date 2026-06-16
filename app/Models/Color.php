<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ColorImageProduct;
class Color extends Model
{
    public $fillable = ['name'];
    public function colorimageproduct(){
        return $this->belongsToMany(ColorImageProduct::class,'color_image_product_colors','colors_id','color_image_product_id');
    }

}
