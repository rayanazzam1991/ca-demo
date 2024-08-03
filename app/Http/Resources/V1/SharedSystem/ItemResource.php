<?php

namespace App\Http\Resources\V1\SharedSystem;

use App\Core\Cart\Infrastructure\Eloquent\CartModel;
use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;
use App\Core\Favourite\Infrastructure\Eloquent\FavouriteModel;
use App\Core\Reminder\Infrastructure\Eloquent\ReminderModel;
use App\Http\Resources\V1\Distributor\DistributorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
{
    protected static $using = [];
    public static function using($using = [])
    {
        static::$using = $using;
    }

    private function getItemDistributor()
    {
        return
            isset(self::$using['distributor'])
            ? DistributorResource::make(ItemResource::$using['distributor'])
            : DistributorResource::make(DistributorModel::where('tenant_id', $this->tenant_id)->first());
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
            'name' => $this->{'name_' . app()->getLocale()} ?? $this->name_ar,
            'code' => $this->code,
            'specifications' => $this->specifications,
            'min_quantity' => $this->min_quantity ?? null,
            'max_quantity' => $this->max_quantity ?? null,
            'safety_stock' => $this->safety_stock ?? null,
            'order_limit' => $this->order_limit ?? null,
            'order_limit_num' => $this->order_limit_num ?? null,
            'current_quantity' => $this->current_quantity ?? null,
            'manufacturer' => isset($this->manufacturer) ? ManufacturerResource::make($this->manufacturer) : null,
            'files' => isset($this->files) ? MediaResource::collection($this->files) : [],
            'category' => isset($this->category) ? ItemCategoryResource::make($this->category) : null,
            'dosage' => isset($this->dosage) ? DosageResource::make($this->dosage) : null,
            'source' => isset($this->source) ? SourceResource::make($this->source) : null,
            'item_location' => isset($this->item_location) ? ItemLocationResource::make($this->item_location) : null,
            'country_of_manufacture' => isset($this->country_of_manufacture) ? CountryOfManufactureResource::make($this->country_of_manufacture) : null,
            'item_color' => isset($this->item_color) ? ItemColorResource::make($this->item_color) : null,
            'item_model' => isset($this->item_model) ? ItemColorResource::make($this->item_model) : null,
            'units_prices' => isset($this->units_prices) ? ItemUnitPriceResource::collection($this->units_prices) : null,
            'titers_active_ingredients' => isset($this->titers_active_ingredients) ? ItemTiterActiveIngredientResource::collection($this->titers_active_ingredients) : null,
            'item_offers' => isset($this->item_offers) ? ItemOfferResource::collection($this->item_offers) : null,
            'price_history' => isset($this->price_history) ? ItemPriceHistoryResource::collection($this->price_history) : null,
            'distributor' => $this->getItemDistributor(),
            'is_in_cart' => isset(self::$using['distributor']) ? CartModel::where('user_id', auth()->id())
                ->where('distributor_id', self::$using['distributor']->id)
                ->whereHas('item', function ($query) {
                    return $query->where('item_id', $this->id);
                })->exists() : true,
            'is_cart_enable' => !$this->is_notify,
            'is_in_wish_list' => FavouriteModel::where('item_id', $this->id)->where('user_id', auth()->id())->exists(),
            'is_notify' => ReminderModel::where('item_id', $this->id)->where('distributor_id', $this->getItemDistributor()?->id)->where('user_id', auth()->id())->exists() ?? false,

        ];
    }
}
