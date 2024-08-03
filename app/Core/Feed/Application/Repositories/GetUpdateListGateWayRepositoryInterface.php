<?php

namespace App\Core\Feed\Application\Repositories;

use App\Core\Feed\Application\Filter\FeedFilter;

interface GetUpdateListGateWayRepositoryInterface
{
    public function getUpdateList(FeedFilter $filter);
}
