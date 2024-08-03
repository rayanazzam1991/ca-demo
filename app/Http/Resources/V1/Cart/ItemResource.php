<?php

namespace App\Http\Resources\V1\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>  $this->id,
            'item_unit_id' => $this->item_unit_id,
            'item_id' => $this->item_id,
            'order_limit' => $this->order_limit,
            'order_limit_num' => $this->order_limit_num,
            'name' => $this->name,
            'qty' => $this->qty,
            'unit_name' => $this->unit_name,
            'price' => $this->price,
            'total_price' => $this->total_price,
            'img' =>$this->img,
            'dosage' => $this->dosage,
            'item_offers' => $this->item_offers,
//            'distributor' => $this->distributor
        ];
    }
}
