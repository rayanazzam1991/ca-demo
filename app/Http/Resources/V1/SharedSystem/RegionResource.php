<?php

namespace App\Http\Resources\V1\SharedSystem;

use App\Core\Shared\City\CityModel;
use App\Core\Shared\Region\RegionModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'name' => $this->{'name_'.app()->getLocale()},
            'status' => $this->status??1,
            'code' => $this->code,
            'city_code' =>isset($this->parent_region_id)?null: CityModel::whereId($this->city_id)->first()?->code,
            'parent_region_code' =>isset($this->parent_region_id)? RegionModel::whereId($this->parent_region_id)->first()?->code:null,
            'city' => CityResource::make($this->whenLoaded('city')),
            'parent' => RegionResource::make($this->whenLoaded('parentRegion')),
            'created_at' => $this->created_at->format('Y-m-d'),
            'createdBy' => $this->createdUser?->full_name_ar,

        ];
    }
}
