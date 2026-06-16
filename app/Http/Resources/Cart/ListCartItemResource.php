<?php

namespace App\Http\Resources\Cart;

use App\Http\Resources\CartItem\CreateCartItemResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListCartItemResource extends JsonResource
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

            'cart'=>CreateCartItemResource::collection($this->cartitems),
            'expire_at'=>$this->expire_at,
            'created_at'=>$this->created_at,
            // 'updated_at'=>$this->updated_at,
        ];
    }
}
