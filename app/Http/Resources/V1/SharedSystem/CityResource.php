<?php

namespace App\Http\Resources\V1\SharedSystem;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'name' => $this->{'name_'.app()->getLocale()},
            'code' => $this->code,
            'status' => $this->status,
            'createdAt' => ($this->created_at)?$this->created_at->format('Y-m-d'):Carbon::now()->toDateString(),
            'createdBy' => $this->createdUser?->full_name_ar,
        ];
    }
}
