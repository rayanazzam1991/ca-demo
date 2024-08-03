<?php

namespace App\Http\Resources\V1\ActivityLog;

use Illuminate\Http\Resources\Json\JsonResource;

class ActivityLogListResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'log_name' => $this->log_name,
            'description' => $this->description,
            'event' => $this->event,
            'event_ar' => $this->event_ar,
            'subject_name_ar' => $this->subject_name_ar,
            'subject_name_en' => $this->subject_name_en,
            'subject_id' => $this->subject_id,
            'created_by' => $this->createdUser?->full_name_ar,
            'created_at' => $this->created_at->format('Y/m/d h:i'),
        ];
    }
}
