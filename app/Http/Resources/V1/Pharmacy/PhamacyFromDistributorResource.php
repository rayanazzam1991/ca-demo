<?php

namespace App\Http\Resources\V1\Pharmacy;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhamacyFromDistributorResource extends JsonResource
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
            'mobile_number' => $this->mobile_number,
            'name' => app()->getLocale() == 'ar' ? $this->client_name_ar : ($this->client_name_en ?? $this->client_name_ar),
        ];
    }
}
