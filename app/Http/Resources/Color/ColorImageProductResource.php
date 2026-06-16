<?php

namespace App\Http\Resources\Color;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Enum\Image\ProductEnum;
use App\Http\Resources\ColorResource;
class ColorImageProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'color' => $this->colors->first()?->name,
            'image' => $this->getFirstMediaUrl(ProductEnum::GALLERY->value),
        ];
    }
}
