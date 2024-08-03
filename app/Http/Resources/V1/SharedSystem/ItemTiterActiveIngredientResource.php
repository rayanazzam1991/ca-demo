<?php

namespace App\Http\Resources\V1\SharedSystem;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemTiterActiveIngredientResource extends JsonResource
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
            'item' => isset($this->item)?ItemResource::make($this->item):null,
            'titer' =>isset($this->titer)? ItemTiterResource::make($this->titer):null,
            'active_ingredient' =>isset($this->active_ingredient)? ActiveIngredientResource::make($this->active_ingredient):null,
        ];
    }
}
