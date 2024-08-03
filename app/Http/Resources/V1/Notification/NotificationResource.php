<?php

namespace App\Http\Resources\V1\Notification;

use App\Http\Resources\V1\Distributor\DistributorResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'title' => $this->{'title_'.app()->getLocale()},
            'description' => $this->{'description_'.app()->getLocale()},
            'type' => $this->type,
            'status' => $this->status,
            'schedule_time' => $this->schedule_time,
            'user_ids' => $this->user_ids(),
            'delivery_men_ids' => $this->delivery_man_ids(),
            'createdBy' => $this->createdUser?->full_name_ar,
            'createdAt' => Carbon::createFromTimestamp($this->created_at)->toDateString(),
        ];
    }
}
