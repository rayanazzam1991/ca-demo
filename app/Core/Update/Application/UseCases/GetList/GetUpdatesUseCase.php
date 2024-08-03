<?php

namespace App\Core\Update\Application\UseCases\GetList;

use App\Core\Update\Application\Filter\UpdateFilter;
use App\Core\Update\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Http\Resources\V1\Update\UpdateResource;

interface GetUpdatesUseCase
{
    public function getUpdates(UpdateFilter $filter):JsonPaginationResourceViewModel;
}
