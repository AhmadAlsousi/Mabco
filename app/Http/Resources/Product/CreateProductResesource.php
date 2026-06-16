<?php

namespace App\Http\Resources\Product;

use App\Enum\Image\ProductEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateProductResesource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'=>$this->name,
            'price'=>$this->price,
            'subcategory_id'=>$this->subcategory->name,
            'image'=>$this->getFirstMediaUrl(ProductEnum::IMAGE->value),
        ];
    }
}
