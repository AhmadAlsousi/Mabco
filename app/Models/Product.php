<?php

namespace App\Models;

use App\Enum\Image\ProductEnum;
use Illuminate\Database\Eloquent\Model;

use App\Models\Property;
use App\Models\Subcategory;

use App\Models\Color;
use App\Models\CartItem;
use App\Models\ColorImageProduct;
// use App\Models\Product;


use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class Product extends Model implements HasMedia
{
     use InteractsWithMedia;
     public function registerMediaCollections(): void
    {
        $this->addMediaCollection(ProductEnum::IMAGE->value)->useDisk(ProductEnum::IMAGE->value);
        $this->addMediaCollection(ProductEnum::GallaryProduct->value)->useDisk(ProductEnum::GallaryProduct->value);

    }
    public $fillable = ['name', 'price','subcategory_id','offer_id','color_image_products_id'];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function offers()
    {
        return $this->hasMany(Offer::class, 'products_id', 'id');
    }

  public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    public function properties()
    {
        return $this->hasMany(Property::class);
    }

    public function colorImageProduct()
    {
        return $this->belongsTo(ColorImageProduct::class, 'color_image_products_id');
    }
}
