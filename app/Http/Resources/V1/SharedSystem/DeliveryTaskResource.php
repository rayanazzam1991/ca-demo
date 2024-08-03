<?php

namespace App\Http\Resources\V1\SharedSystem;

use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;
use App\Http\Resources\V1\Distributor\DistributorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryTaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $distributor = DistributorModel::where('tenant_id',$this->tenant_id)->first();
        OrderResource::using($distributor);
        return [
            'id' => $this->id,
            'package' => PackageResource::make($this->package),
            'type' => $this->type,
            'status' => $this->status,
            'close_datetime' => $this->close_datetime ??null,
            'distributor' => DistributorResource::make($distributor),
            'latest_expected_delivery_time' => $this->latest_expected_delivery_time??null,
            'created_at' => $this->created_at,
        ];
    }
}
