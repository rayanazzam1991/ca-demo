<?php

namespace App\Http\Resources\V1\Auth;

use App\Http\Resources\Media\MediaResourc;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
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
            'full_name_ar' => $this->full_name_ar,
            'username' => $this->username,
            'phone_number' => $this->phone_number,
            'token' => $this->token
        ];
    }
}
