<?php

namespace App\Core\Item\Application\UseCases\Search;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Presentation\ViewModels\JsonPaginationResourceViewModel;

interface SearchItemsUseCaseInterface
{
    public function getList(ItemFilter $itemFilter);
}
