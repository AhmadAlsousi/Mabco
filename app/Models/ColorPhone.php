<?php

namespace App\Models;

use App\Enum\Image\ColorPhoneEnum;
use App\Enum\Image\ProductEnum;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ColorPhone extends Model implements HasMedia
{
    use InteractsWithMedia;

    public $fillable = ['color_id','phone_id'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(ColorPhoneEnum::IMAGE->value)->useDisk(ColorPhoneEnum::IMAGE->value);
    }
    public function phoneproduct()
    {
        return $this->belongsTo(phoneProducts::class);

    }
    public function colors(){
         return $this->belongsTo(Color::class,'color_id');
    }
}
