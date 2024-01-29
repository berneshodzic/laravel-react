<?php

namespace App\Product\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'product_type' => ProductTypeResource::make($this->whenLoaded('ProductType')),
            'valid_from' => $this->valid_from,
            'valid_to' => $this->valid_to,
            'variants' => VariantResource::collection($this->whenLoaded('Variant')),
        ];
    }
}
