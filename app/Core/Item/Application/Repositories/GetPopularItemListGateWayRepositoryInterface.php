<?php

namespace App\Core\Item\Application\Repositories;

use App\Core\Item\Application\Filter\ItemFilter;

interface GetPopularItemListGateWayRepositoryInterface
{
    public function getItemList(ItemFilter $filter);
}
