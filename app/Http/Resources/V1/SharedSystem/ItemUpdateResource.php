<?php

namespace App\Http\Resources\V1\SharedSystem;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemUpdateResource extends JsonResource
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
            'item' => isset($this->item)?ItemResource::make($this->item):null,
            'update_type' => $this->update_type,
            'current_purchase_price_new' => $this->current_purchase_price_new,
            'current_purchase_price_old' => $this->current_purchase_price_old,
            'created_at' => $this->created_at,
            'since' => $this->calcSince($this->created_at)
        ];
    }
    private function calcSince($created_at)
    {
        $carbonDate = Carbon::parse($created_at);
        $now = Carbon::now();
        $dayDiff = $carbonDate->diffInDays($now);

        if ($dayDiff === 0) {
           return  __('main.today');
        } elseif ($dayDiff === 1) {
            return __('main.yesterday');
        } elseif($dayDiff < 10) {
            return __('main.day_plural', ['number' => $dayDiff]);
        } else {
            return __('main.day_single', ['number' => $dayDiff]);

        }
    }

}
