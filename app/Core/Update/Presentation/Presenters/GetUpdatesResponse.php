<?php

namespace App\Core\Update\Presentation\Presenters;

use App\Core\Update\Application\UseCases\GetList\GetUpdatesUseCaseOutput;
use App\Core\Update\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\V1\Update\UpdateResource;

class GetUpdatesResponse implements GetUpdatesUseCaseOutput
{

    public function updatesList($withDataDTO): JsonPaginationResourceViewModel
    {
        return new JsonPaginationResourceViewModel(
            UpdateResource::collection($withDataDTO),
            PaginationResource::make($withDataDTO)
        );
    }
}
