<?php

namespace App\Http\Resources\V1\Tenant;

use App\Http\Resources\Media\MediaResourc;
use App\Http\Resources\V1\Address\AddressResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
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
            'database' => $this->database,
            'domain' => $this->domain,
        ];
    }
}


