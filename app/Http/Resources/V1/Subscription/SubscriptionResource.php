<?php

namespace App\Http\Resources\V1\Subscription;

use App\Http\Resources\Media\MediaResourc;
use App\Http\Resources\V1\Address\AddressResource;
use App\Http\Resources\V1\Distributor\DistributorResource;
use App\Http\Resources\V1\Tenant\TenantResource;
use App\Http\Resources\V1\User\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'paid_amount' => $this->paid_amount,
            'type' => $this->type,
            'status' => $this->status,
            'created_by' => $this->createdUser->full_name_ar,
            'created_at' => Carbon::createFromTimestamp($this->created_at)->toDateString(),
            'distributor' => DistributorResource::make($this->whenLoaded('distributor'))
        ];
    }
}


