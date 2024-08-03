<?php

namespace App\Http\Resources\V1\SharedSystem;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'sub_region' => isset($this->subRegion)?RegionResource::make($this->subRegion):null,
            'street' => $this->street,
            'building_number' => $this->building_number,
            'lat' => $this->lat,
            'lng' => $this->lng,
        ];
    }
}
