<?php

namespace App\Core\Item\Application\Repositories;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Infrastructure\Eloquent\ItemModel;
use Illuminate\Pagination\LengthAwarePaginator;

interface ItemRepositoryInterface
{
    public function getList(ItemFilter $itemFilter):LengthAwarePaginator;
    public function getOne(int $id):ItemModel;
}
