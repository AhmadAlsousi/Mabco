<?php

namespace App\Http\Resources\Offer;

use App\Enum\Image\ProductEnum;
use App\Http\Resources\Offer\Product\ListProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListOfferResource extends JsonResource
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
            "discount" => $this->discount,
            "startDate" => $this->startDate,
            "endDate" => $this->endDate,
            "status" => $this->status,
           "product"=>ListProductResource::collection($this->Product)

        ];
    }
}
