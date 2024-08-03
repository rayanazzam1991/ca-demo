<?php

namespace App\Core\Feed\Application\UseCases\GetUpdateList;

use App\Core\Feed\Application\Filter\FeedFilter;

interface GetListUpdateUseCaseInterface
{
    public function index(FeedFilter $filter);
}
