<?php

namespace App\Core\Task\Presentation\Presenters;

use App\Core\Item\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Core\Task\Application\UseCases\GetTaskList\GetTaskListOutUseCaseInterface;
use App\Http\Resources\V1\SharedSystem\DeliveryTaskResource;
use App\Http\Resources\V1\SharedSystem\PaginationResource;

class GetTaskListUseCaseResponse implements GetTaskListOutUseCaseInterface
{
    public function getList($tasks)
    {
        return new JsonPaginationResourceViewModel(
            DeliveryTaskResource::collection($tasks->data),
            PaginationResource::make($tasks->pagination),
        );
    }
}
