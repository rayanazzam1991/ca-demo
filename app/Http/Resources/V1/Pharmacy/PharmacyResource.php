<?php

namespace App\Http\Resources\V1\Pharmacy;

use App\Http\Resources\V1\Address\AddressResource;
use App\Http\Resources\V1\SharedSystem\ShiftResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PharmacyResource extends JsonResource
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
            'name' => app()->getLocale() == 'ar' ? $this->name_ar : ($this->name_en ?? $this->name_ar),
            'license_number' => $this->license_number ,
            'phone_number' => $this->phone_number,
            'status' => $this->status,
            'address' => AddressResource::make($this->whenLoaded('address')),
            'shifts' => ShiftResource::collection($this->whenLoaded('shifts'))
        ];
    }
}
