<?php

namespace App\Http\Resources\V1\DeliverGroup;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliverGroupResource extends JsonResource
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
            'status' => $this->status,
            'code' => $this->code,
            'createdBy' => $this->createdUser?->full_name_ar,
            'createdAt' => Carbon::createFromTimestamp($this->created_at)->toDateString(),
        ];
    }

}
