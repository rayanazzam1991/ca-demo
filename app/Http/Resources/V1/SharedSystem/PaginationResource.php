<?php

namespace App\Http\Resources\V1\SharedSystem;

use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
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
            'total'=>$this->total,
            'count'=>$this->count,
            'per_page'=>$this->per_page,
            'page'=>$this->page,
            'max_page'=>$this->max_page,
        ];
    }

}
