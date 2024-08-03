<?php

namespace App\Core\Item\Application\Repositories;

use App\Core\Item\Application\Filter\ItemFilter;
use Illuminate\Pagination\LengthAwarePaginator;

interface GetItemGateWayRepositoryInterface
{
    public function getItem($domain,$item_id);
}
