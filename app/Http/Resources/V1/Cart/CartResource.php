<?php

namespace App\Http\Resources\V1\Cart;

use App\Http\Resources\V1\Distributor\DistributorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'total'=> $this['sub_total'],
            'sub_total' => $this['sub_total'],
            'tax' => 0,
            'discount' => 0,
            'distributor' =>DistributorResource::make(static::$distributor)
        ];
    }
}
