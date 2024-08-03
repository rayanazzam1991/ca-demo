<?php

namespace App\Core\Update\Application\UseCases\GetList;

use App\Core\Update\Application\DTO\UpdateWithPaginatedDataDTO;
use App\Core\Update\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Core\Update\Presentation\ViewModels\JsonResourceViewModel;

interface GetUpdatesUseCaseOutput
{
    public function updatesList($withDataDTO) :JsonPaginationResourceViewModel;
}
