<?php

namespace App\Http\Resources\V1\Address;

use App\Core\Distributor\DistributorResource;
use App\Core\Shared\City\CityResource;
use App\Core\Shared\Region\RegionResource;
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
            'street' => $this->street,
            'building_number' => $this->building_number,
            'lat' => $this->lat,
            'lng'=>$this->lng,
            'city' => CityResource::make($this->region->city),
            'region' => RegionResource::make($this->region->parentRegion),
            'sub_region' => RegionResource::make($this->region),
        ];
    }
}
