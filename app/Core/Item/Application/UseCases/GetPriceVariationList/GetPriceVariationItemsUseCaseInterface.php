<?php

namespace App\Core\Item\Application\UseCases\GetPriceVariationList;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Presentation\ViewModels\JsonPaginationResourceViewModel;

interface GetPriceVariationItemsUseCaseInterface
{
    public function getList(ItemFilter $itemFilter);
}
