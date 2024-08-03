<?php

namespace App\Core\Item\Application\Repositories;

use App\Core\Item\Application\Filter\ItemFilter;

interface GetItemListGateWayRepositoryInterface
{
    public function getItemList(ItemFilter $filter,$domain);
}
