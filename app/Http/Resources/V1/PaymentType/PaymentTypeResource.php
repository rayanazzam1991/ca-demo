<?php

namespace App\Http\Resources\V1\PaymentType;

use App\Core\Cart\Infrastructure\Eloquent\CartModel;
use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;
use App\Core\Favourite\Infrastructure\Eloquent\FavouriteModel;
use App\Core\Reminder\Infrastructure\Eloquent\ReminderModel;
use App\Http\Resources\V1\Distributor\DistributorResource;
use App\Http\Resources\V1\SharedSystem\CountryOfManufactureResource;
use App\Http\Resources\V1\SharedSystem\DosageResource;
use App\Http\Resources\V1\SharedSystem\ItemCategoryResource;
use App\Http\Resources\V1\SharedSystem\ItemColorResource;
use App\Http\Resources\V1\SharedSystem\ItemLocationResource;
use App\Http\Resources\V1\SharedSystem\ItemOfferResource;
use App\Http\Resources\V1\SharedSystem\ItemPriceHistoryResource;
use App\Http\Resources\V1\SharedSystem\ItemTiterActiveIngredientResource;
use App\Http\Resources\V1\SharedSystem\ItemUnitPriceResource;
use App\Http\Resources\V1\SharedSystem\ManufacturerResource;
use App\Http\Resources\V1\SharedSystem\MediaResource;
use App\Http\Resources\V1\SharedSystem\SourceResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentTypeResource extends JsonResource
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
            'name' => $this->{'name_'.app()->getLocale()},
            'name_en' => $this->name_en,
            'name_ar' => $this->name_ar,
            'code' => $this->code,
            'status' => $this->status,
            'createdBy' => $this->createdUser?->full_name_ar,
            'createdAt' => Carbon::createFromTimestamp($this->created_at)->toDateString(),
        ];
    }

}
