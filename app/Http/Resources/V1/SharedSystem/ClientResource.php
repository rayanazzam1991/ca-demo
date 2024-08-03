<?php

namespace App\Http\Resources\V1\SharedSystem;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'client_name_ar' => $this->client_name_ar,
            'client_name_en' => $this->client_name_en,
            'contact_person_name_ar' => $this->contact_person_name_ar,
            'contact_person_name_en' => $this->contact_person_name_en,
            'phone_number' => $this->phone_number,
            'mobile_number' => $this->mobile_number,
            'address' => isset($this->address)?AddressResource::make($this->address):null,
            'shifts' => isset($this->shifts)?PharmacyShiftResource::collection($this->shifts):null,
        ];
    }
}
