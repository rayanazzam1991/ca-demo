<?php

namespace App\Http\Resources\V1\Auth;

use App\Http\Resources\Media\MediaResourc;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryLoginResource extends JsonResource
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
            'name' => $this->{'name_'.app()->getLocale()},
            'phone_number' => $this->phone_number,
            'distributor_id' => $this->distributor_id,
            'token' => $this->token
        ];
    }
}
