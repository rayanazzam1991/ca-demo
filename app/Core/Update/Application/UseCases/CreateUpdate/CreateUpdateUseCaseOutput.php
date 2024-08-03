<?php

namespace App\Core\Update\Application\UseCases\CreateUpdate;

use App\Core\Update\Application\DTO\UpdateWithPaginatedDataDTO;
use App\Core\Update\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\V1\Update\UpdateResource;

interface CreateUpdateUseCaseOutput
{
    public function updateCreate(UpdateWithPaginatedDataDTO $dataDTO): JsonResourceViewModel;
}
