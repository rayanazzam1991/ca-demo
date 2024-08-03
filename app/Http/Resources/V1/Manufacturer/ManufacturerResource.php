<?php

namespace App\Http\Resources\V1\Manufacturer;

use App\Http\Resources\Media\MediaResourc;
use App\Http\Resources\V1\Address\AddressResource;
use App\Http\Resources\V1\DeliverGroup\DeliverGroupResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ManufacturerResource extends JsonResource
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
            'name_en' => $this->name_en,
            'code' => $this->code,
            'name_ar' => $this->name_ar,
            'mobile_number' => $this->mobile_number,
            'email' => $this->email,
            'status' => $this->status,
            'created_by' => $this->createdUser?->full_name_ar,
            'created_at' => Carbon::createFromTimestamp($this->created_at)->toDateString(),
            'image' => MediaResourc::make($this->whenLoaded('medias')),
            'address' => AddressResource::make($this->address),
        ];
    }

}
