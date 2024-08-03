<?php

namespace App\Http\Resources\V1\DeliverMan;

use App\Http\Resources\Media\MediaResourc;
use App\Http\Resources\V1\DeliverGroup\DeliverGroupResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliverManResource extends JsonResource
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
            'name_ar' => $this->name_ar,
            'phone_number' => $this->phone_number,
            'vehicle_type' => $this->vehicle_type,
            'status' => $this->status,
            'is_online' => $this->is_online,
            'distributor_id' => $this->distributor_id,
            'createdBy' => $this->createdUser?->full_name_ar,
            'createdAt' => Carbon::createFromTimestamp($this->created_at)->toDateString(),
            'media' => MediaResourc::make($this->whenLoaded('medias')),
            'group_ids' => $this->groups()->pluck('delivery_group_id')->toArray(),
            'groups' => DeliverGroupResource::collection($this->whenLoaded('groups')),
        ];
    }

}
