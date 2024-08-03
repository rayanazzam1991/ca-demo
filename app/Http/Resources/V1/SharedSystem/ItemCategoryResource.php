<?php

namespace App\Http\Resources\V1\SharedSystem;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemCategoryResource extends JsonResource
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
            'name' => $this->{'name_'.app()->getLocale()}??$this->name_ar,
            'children' => isset($this->children)?ItemCategoryResource::collection($this->children):null,
            'parent' => isset($this->parent)?ItemCategoryResource::make($this->parent):null,
        ];
    }
}