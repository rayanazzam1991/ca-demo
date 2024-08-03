<?php

namespace App\Http\Resources\V1\SharedSystem;

use App\Http\Resources\Item\ItemResource;
use App\Http\Resources\Shared\CreatedByResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'item'=> isset($this->update_type)?ItemUpdateResource::make($this):null,
            'news' => !isset($this->update_type)?FeedResource::make($this):null,
            'is_item' => isset($this->update_type)
        ];
    }
}
