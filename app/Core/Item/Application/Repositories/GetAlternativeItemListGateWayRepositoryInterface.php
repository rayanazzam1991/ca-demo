<?php

namespace App\Core\Item\Application\Repositories;

use App\Core\Item\Application\Filter\ItemFilter;

interface GetAlternativeItemListGateWayRepositoryInterface
{
    public function getAlternativeItemList(ItemFilter $filter,string $domain,int $id);
}
