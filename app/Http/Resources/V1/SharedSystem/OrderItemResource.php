<?php

namespace App\Http\Resources\V1\SharedSystem;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
            'item_unit' =>isset($this->item_unit)? ItemUnitPriceResource::make($this->item_unit):null,
            'quantity' => $this->quantity,
            'total_price' => $this->total_price,
            'unit_price' => number_format(floatval(str_replace(',', '', $this->total_price)) / floatval(str_replace(',', '', $this->quantity))),
            'created_at' => $this->created_at,
            "gift"=> $this->gift,
        ];
    }
}
