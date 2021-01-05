<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'created_at' => $this->created_at,
            'cover' => $this->getCoverImage(),
            'description' => $this->description,
            'has_offer' => $this->has_offer,
            'offer_type' => $this->offer_type,
            'amount_off' => $this->amount_off,
            'percent_off' => $this->percent_off,
            'price' => $this->price,
            'path' => ProductImageResource::collection($this->images),
        ];
    }
}
