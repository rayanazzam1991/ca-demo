<?php

namespace App\Http\Resources\V1\SharedSystem;

use App\Http\Resources\V1\Pharmacy\PharmacyResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShiftResource extends JsonResource
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
            'pharmacy' => PharmacyResource::make($this->whenLoaded('pharmacy')),
            'day_of_week' => $this->day_of_week,
            'start_time' => Carbon::make($this->start_time)->format('H:i'),
            'end_time' => Carbon::make($this->end_time)->format('H:i'),
        ];
    }
}
