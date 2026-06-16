<?php

namespace App\Http\Resources\Offer;

use App\Http\Resources\Offer\Product\ProOffShowResource;
use App\Http\Resources\Product\Phone\Show\phoneResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferShowResource extends JsonResource
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
            'discount'=>$this->discount,
            'startDate'=>$this->startDate,
            'endDate'=>$this->endDate,
            'status'=>$this->status,
            'Products'=>ProOffShowResource::collection($this->Product)
        ];
    }
}
