<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Property\PropertyResource;
use App\Http\Resources\Color\ColorImageProductResource;
use App\Enum\Image\ProductEnum;

class DetailsProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    // public function toArray(Request $request): array
    // {
    //     return [
    //         'id' => $this->id,
    //         'name' => $this->name,
    //         'price' => $this->price,
    //         'image' => $this->getFirstMediaUrl(ProductEnum::GallaryProduct->value),
    //         'color_image_products' => ColorImageProductResource::collection(
    //             collect($this->colorImageProduct ? [$this->colorImageProduct] : [])
    //         ),
    //         'properties' => PropertyResource::collection($this->properties),
    //         // 'prop'=>$this->properties
    //     ];
    // }
    public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'name' => $this->name,
        'price' => $this->price,
        'properties' => PropertyResource::collection($this->properties),
        'image' => $this->getFirstMediaUrl(ProductEnum::IMAGE->value),
        'gallery' => $this->getMedia(ProductEnum::GallaryProduct->value)
                 ->map(fn($media) => $media->getUrl())
                 ->toArray(),
        'color_image_products' => ColorImageProductResource::collection(
            collect($this->colorImageProduct ? [$this->colorImageProduct] : [])
        ),
    ];
}
}
