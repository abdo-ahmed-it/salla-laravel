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
            'description' => $this->description,
            'price' => $this->price,
            'image_url' => $this->image_url,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }


    /**
     * The relationships that should be cast.
     *
     * @var array<string, string>
     */
    public function casts(): array
    {
        return [
            'price' => 'number',
            'quantity' => 'integer',
        ];
    }
}
