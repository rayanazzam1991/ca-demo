<?php

namespace App\Core\Item\Application\UseCases\GetList;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Presentation\ViewModels\JsonPaginationResourceViewModel;

interface GetItemsUseCaseInterface
{
    public function getList(ItemFilter $itemFilter);
}
