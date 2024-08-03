<?php

namespace App\Http\Resources\V1\Distributor;

use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;
use App\Core\DistributorSubscription\Infrastructure\Eloquent\DistributorSubscriptionModel;
use App\Http\Resources\Media\MediaResourc;
use App\Http\Resources\V1\Address\AddressResource;
use App\Http\Resources\V1\Subscription\SubscriptionResource;
use App\Http\Resources\V1\Tenant\TenantResource;
use App\Http\Resources\V1\User\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DistributorResource extends JsonResource
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
            'name' => $this->name,
            'name_en' => $this->name_en,
            'name_ar' => $this->name_ar,
            'status' => $this->status,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'createdBy' => $this->createdUser?->full_name_ar,
            'createdAt' => Carbon::createFromTimestamp($this->created_at)->toDateString(),
            'img' => MediaResourc::make($this->whenLoaded('medias')),
            'url' => $this->whenLoaded('medias') && $this->medias ? $this->medias->url : asset('storage/Distributor-avatar.png'),
            'address' => AddressResource::make($this->address),
            'tenant' => TenantResource::make($this->whenLoaded('tenant')),
            'lastSubscription' => SubscriptionResource::make($this->subscriptions->last()),
            'manufacturers' => $this->manufacturers ?? [],
            'is_expire' => !(DistributorSubscriptionModel::where('distributor_id', $this->id)
                ->where('status', 1)
                ->where('end_date', '>', \Illuminate\Support\Carbon::now())
                ->whereHas('distributor', function ($q) {
                    return $q->where('status', 1);
                })
                ->exists())
        ];
    }
}
