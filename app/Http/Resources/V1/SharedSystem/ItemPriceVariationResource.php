<?php

namespace App\Http\Resources\V1\SharedSystem;

use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class ItemPriceVariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        ItemResource::using(['distributor'=>DistributorModel::where('id',$this->item->tenant_id)->first()]);
        return [
            'item' => isset($this->item)?ItemResource::make($this->item):null,
            'current_purchase_price_new' => (string)$this->current_purchase_price_new,
            'current_purchase_price_old' =>(string)number_format($this->current_purchase_price_old),
            'created_at' => $this->created_at
        ];
    }
}
