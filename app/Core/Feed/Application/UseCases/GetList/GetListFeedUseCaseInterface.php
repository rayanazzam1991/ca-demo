<?php

namespace App\Core\Feed\Application\UseCases\GetList;

use App\Core\Feed\Application\Filter\FeedFilter;

interface GetListFeedUseCaseInterface
{
    public function index(FeedFilter $filter);
}
