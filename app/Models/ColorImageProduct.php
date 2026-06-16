<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\Color;
use App\Models\Property;
use App\Enum\Image\ProductEnum;


class ColorImageProduct extends Model implements HasMedia
{
         use InteractsWithMedia;
    public $fillable = ['colors_id'];

     public function registerMediaCollections(): void
    {
        $this->addMediaCollection(ProductEnum::GALLERY->value)->useDisk(ProductEnum::GALLERY->value);
    }
      public function colors()
    {
return $this->belongsToMany(
        Color::class,
        'color_image_product_colors',
        'color_image_product_id',
        'color_id'
    );    }
    public function property()
    {
        return $this->belongsTo(Property::class);

    }
    public function cartItem()
    {
        return $this->hasMany(CartItem::class);
    }
}
