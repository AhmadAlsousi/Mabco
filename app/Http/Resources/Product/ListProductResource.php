<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Enum\Image\ProductEnum;
use App\Http\Resources\Offer\OfferResource;


class ListProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'price'=>$this->price,
            'offer' => $this->offers->isNotEmpty(),
            // 'subcategory'=>$this->subcategory->count() > 0 ? $this->subcategory->count() : null,
             'offer_details' => $this->offers->isNotEmpty()
    ? [
        'discount' => $this->offers->first()->discount,
        'endDate' => $this->offers->first()->endDate,
      ]
    : null,
            'image' => $this->getFirstMediaUrl(ProductEnum::IMAGE->value),

        ];
    }
}
