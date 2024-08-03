<?php

namespace App\Http\Resources\V1\Banner;

use App\Http\Resources\Media\MediaResourc;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            'title' => $this->title,
            'header_ar' => $this->header_ar,
            'header_en'  => $this->header_en,
            'sub_header_ar'  => $this->sub_header_ar,
            'sub_header_en' => $this->sub_header_en,
            'status' => $this->status,
            'type' => $this->type,
            'position' => $this->position,
            'header' => $this->header,
            'sub_header' => $this->sub_header,
            'medias' => MediaResourc::collection($this->medias)
        ];
    }
}
