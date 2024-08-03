<?php

namespace App\Http\Resources\V1\SharedSystem;

use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;
use App\Http\Resources\V1\Distributor\DistributorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    protected static $distributor;
    public static function using($distributor)
    {
        static::$distributor = $distributor;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sub_total' => $this->sub_total,
            'delivery_man' => $this->order_package?->delivery_man?->{'name_' . app()->getLocale()} ??  $this->order_package?->delivery_man?->name_ar,
            'discount' => $this->discount,
            'tax' => $this->tax,
            'total_price' => $this->total_price,
            'note' => $this->note,
            'expected_delivery_date' => $this->expected_delivery_date,
            'items' => isset($this->items) ? OrderItemResource::collection($this->items) : null,
            'distributor' => isset(self::$distributor)
                ? DistributorResource::make(self::$distributor)
                : DistributorResource::make(DistributorModel::where('tenant_id', $this->tenant_id)->first()),
            'total_quantities' => $this->total_quantities ?? null,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'total_gifts' => $this->total_gifts ?? 0
        ];
    }
}
