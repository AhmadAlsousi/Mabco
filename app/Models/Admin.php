<?php

namespace App\Models;

use App\Enum\Image\AdminEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Admin extends Authenticatable implements HasMedia
{
     use HasApiTokens,InteractsWithMedia ;
    public $fillable = ['name','email','password','access_token_admin'];
        public function registerMediaCollections(): void
    {
        $this->addMediaCollection(AdminEnum::IMAGE->value)->useDisk(AdminEnum::IMAGE->value);
    }
     protected function casts(): array
    {
        return [
        
            'password' => 'hashed',
        ];
    }

}
