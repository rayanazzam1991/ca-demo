<?php

namespace App\Core\Feed\Application\UseCases\GetList;

use App\Core\Feed\Presentation\ViewModels\JsonPaginationResourceViewModel;

interface GetListFeedUseCaseOutputInterface
{
    public function getList($feeds): JsonPaginationResourceViewModel;
}
