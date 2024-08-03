<?php

namespace App\Core\Item\Application\Repositories;

use App\Core\Item\Application\Filter\ItemFilter;

interface SearchItemListGateWayRepositoryInterface
{
    public function getItemList(ItemFilter $filter);
}
