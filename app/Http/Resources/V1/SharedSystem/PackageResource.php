<?php

namespace App\Http\Resources\V1\SharedSystem;

use App\Http\Resources\V1\DeliverMan\DeliverManResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'client' =>isset($this->client)? ClientResource::make($this->client):null,
            'total_price' => $this->total_price,
            'orders' =>isset($this->orders)? OrderResource::collection($this->orders):null,
            'status' => $this->status,
            'total_quantites' => $this->total_quantites,
            'total_discount' => $this->total_discount,
            'sub_total' => $this->sub_total,
            'created_at' => $this->created_at,
        ];
    }
}
