<?php

namespace App\Http\Resources\V1\Update;

use App\Http\Resources\V1\Feed\FeedResource;
use App\Http\Resources\V1\Item\ItemResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'data'=>
                isset($this->update_type->price)?
                ItemResource::make($this->update_type):
                FeedResource::make($this->update_type),
        ];
    }
}
