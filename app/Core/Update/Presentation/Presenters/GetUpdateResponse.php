<?php

namespace App\Core\Update\Presentation\Presenters;

use App\Core\Update\Application\UseCases\GetOne\GetUpdateUseCaseOutput;
use App\Core\Update\Infrastructure\Eloquent\UpdateModel;
use App\Core\Update\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\V1\Update\UpdateResource;

class GetUpdateResponse implements GetUpdateUseCaseOutput
{

    public function getUpdate(UpdateModel $model): JsonResourceViewModel
    {
        return new JsonResourceViewModel(UpdateResource::make($model));
    }
}
