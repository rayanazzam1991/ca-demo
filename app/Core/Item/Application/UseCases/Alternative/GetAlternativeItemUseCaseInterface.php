<?php

namespace App\Core\Item\Application\UseCases\Alternative;

use App\Core\Item\Application\Filter\ItemFilter;

interface GetAlternativeItemUseCaseInterface
{
    public function getAlternativeItemList(ItemFilter $filter,int $id);
}
