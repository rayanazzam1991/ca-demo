<?php

namespace App\Core\Update\Presentation\Presenters;

use App\Core\Update\Application\DTO\UpdateWithPaginatedDataDTO;
use App\Core\Update\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\V1\Update\UpdateResource;

class CreateUpdateResponse implements \App\Core\Update\Application\UseCases\CreateUpdate\CreateUpdateUseCaseOutput
{

    public function updateCreate(UpdateWithPaginatedDataDTO $dataDTO): JsonResourceViewModel
    {
        return new JsonResourceViewModel(new UpdateResource($dataDTO));
    }
}
