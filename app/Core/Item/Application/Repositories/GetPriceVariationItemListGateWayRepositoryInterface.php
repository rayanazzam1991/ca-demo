<?php

namespace App\Core\Item\Application\Repositories;

use App\Core\Item\Application\Filter\ItemFilter;

interface GetPriceVariationItemListGateWayRepositoryInterface
{
    public function getItemList(ItemFilter $filter);
}
