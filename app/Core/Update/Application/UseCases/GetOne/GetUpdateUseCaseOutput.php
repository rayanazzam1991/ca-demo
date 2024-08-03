<?php

namespace App\Core\Update\Application\UseCases\GetOne;

use App\Core\Update\Application\DTO\UpdateWithPaginatedDataDTO;
use App\Core\Update\Infrastructure\Eloquent\UpdateModel;
use App\Core\Update\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Core\Update\Presentation\ViewModels\JsonResourceViewModel;

interface GetUpdateUseCaseOutput
{
    public function getUpdate(UpdateModel $model): JsonResourceViewModel;
}
