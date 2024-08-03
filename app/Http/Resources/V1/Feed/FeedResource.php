<?php

namespace App\Http\Resources\V1\Feed;

use App\Http\Resources\Media\MediaResourc;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedResource extends JsonResource
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
            'title' => $this->{'title_' . app()->getLocale()},
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'description' => $this->description,
            'status' => $this->status,
            'media' => $this->whenLoaded('medias', MediaResourc::make($this->medias)),
            'createdBy' => $this->createdUser?->full_name_ar,
            'since' => $this->calcSince($this->created_at),
            'createdAt' =>  Carbon::createFromTimestamp($this->created_at)->toDateString(),
        ];
    }
    private function calcSince($created_at)
    {
        $carbonDate = Carbon::parse($created_at);
        $now = Carbon::now();
        $dayDiff = $carbonDate->diffInDays($now);

        if ($dayDiff === 0) {
            return  __('main.today');
        } elseif ($dayDiff === 1) {
            return __('main.yesterday');
        } elseif ($dayDiff < 10) {
            return __('main.day_plural', ['number' => $dayDiff]);
        } else {
            return __('main.day_single', ['number' => $dayDiff]);
        }
    }
}
