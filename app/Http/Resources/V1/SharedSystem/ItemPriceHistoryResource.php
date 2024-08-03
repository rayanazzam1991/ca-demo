<?php

namespace App\Http\Resources\V1\SharedSystem;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemPriceHistoryResource extends JsonResource
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
            'current_purchase_price_new' => (string)$this->current_purchase_price_new,
            'current_purchase_price_old' => (string)number_format($this->current_purchase_price_old),
            'created_at' => $this->created_at
        ];
    }
}
