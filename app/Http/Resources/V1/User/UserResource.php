<?php

namespace App\Http\Resources\V1\User;

use App\Http\Resources\Media\MediaResourc;
use App\Http\Resources\V1\Pharmacy\PharmacyResource;
use App\Http\Resources\V1\SharedSystem\ShiftResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(Request $request): array
    {
//        dd($this->pharmacy->shifts);
        return [
            'id'=>$this->id,
            'full_name_ar' => $this->full_name_ar,
            'phone_number'=>$this->phone_number,
            'status' => $this->status,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'pharmacy' => PharmacyResource::make($this->whenLoaded('pharmacy')),
            'medias' => MediaResourc::collection($this->whenLoaded('medias')),
        ];
    }
}
