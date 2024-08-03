<?php

namespace App\Core\Item\Presentation\Presenters;

use App\Core\Item\Application\UseCases\GetPriceVariationList\GetPriceVariationUseCaseOutputInterface;
use App\Core\Item\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\V1\SharedSystem\ItemPriceVariationResource;
use Illuminate\Support\Facades\Log;

class GetPriceVariationItemsUseCaseResponse implements GetPriceVariationUseCaseOutputInterface
{
    public function getList($priceVariations)
    {
        return new JsonResourceViewModel(ItemPriceVariationResource::collection($priceVariations->data));
    }
}
