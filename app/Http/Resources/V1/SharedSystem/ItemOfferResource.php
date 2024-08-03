<?php

namespace App\Http\Resources\V1\SharedSystem;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemOfferResource extends JsonResource
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
            'gift_number' =>$this->gift_number ?? null,
            'gift_for_every' => $this->gift_for_every ?? null,
            'accept_division' => $this->accept_division,
            'accept_fraction' => $this->accept_fraction,
            'for_all_clients' => $this->for_all_clients,
            'end_time' => $this->end_time,
            'item' => isset($this->item)?ItemResource::make($this->item):null
        ];
    }
}
