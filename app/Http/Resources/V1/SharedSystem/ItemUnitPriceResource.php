<?php

namespace App\Http\Resources\V1\SharedSystem;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemUnitPriceResource extends JsonResource
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
            'item' =>isset($this->item)? ItemResource::make($this->item):null,
            'unit' =>isset($this->unit)? UnitResource::make($this->unit):null,
            'is_default' => $this->is_default,
            'unit_barcode' => $this->unit_barcode,
            'conversion_factor' => $this->conversion_factor ?? null,
            'wholesale_price' => $this->wholesale_price ?? null,
            'current_purchase_price' => $this->current_purchase_price ?? null,
            'old_purchase_price' => $this->old_purchase_price?? null,
            'current_consumer_price' => $this->current_consumer_price ?? null,
            'old_consumer_price' => $this->old_consumer_price ?? null,
            'last_purchased_price' => $this->last_purchased_price?? null,
        ];
    }
}
