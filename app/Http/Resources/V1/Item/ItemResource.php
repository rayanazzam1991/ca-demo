<?php

namespace App\Http\Resources\V1\Item;

use App\Http\Resources\V1\Distributor\DistributorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
            'price' =>$this->price,
            'new_price' =>$this->new_price,
            'img' => $this->img,
            'distributor' => DistributorResource::make($this->distributor)
        ];
    }
}
