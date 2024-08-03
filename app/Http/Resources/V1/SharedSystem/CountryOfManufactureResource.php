<?php

namespace App\Http\Resources\V1\SharedSystem;

use App\Http\Resources\V1\SharedSystem\CreatedByResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryOfManufactureResource extends JsonResource
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
            'name' => $this->{'name_'.app()->getLocale()}??$this->name_ar,
        ];
    }
}
