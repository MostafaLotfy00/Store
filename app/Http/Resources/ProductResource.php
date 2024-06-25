<?php

namespace App\Http\Resources;

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
            'price' => [
                'normal' => $this->price,
                'compare' => $this->compare_price,
            ],
            'slug' => $this->slug,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'image' => $this->image_url,
            'category' =>  [
                'id'=> $this->category->id ?? null,
                'name' => $this->category->name ?? null,
            ],
            'store' => [
                'id' => $this->store->id,
                'name' => $this->store->name,
            ]
        ];
    }
}
