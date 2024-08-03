<?php

namespace App\Core\Item\Application\UseCases\GetPopularList;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Presentation\ViewModels\JsonPaginationResourceViewModel;

interface GetPopularItemsUseCaseInterface
{
    public function getList(ItemFilter $itemFilter);
}
