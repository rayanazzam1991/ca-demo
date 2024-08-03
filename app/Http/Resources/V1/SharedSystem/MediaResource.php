<?php

namespace App\Http\Resources\V1\SharedSystem;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'is_featured' => $this->is_featured,
            'url'=>$this->full_path??"",
        ];
    }
}
