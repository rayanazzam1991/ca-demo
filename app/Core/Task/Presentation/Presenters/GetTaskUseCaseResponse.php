<?php

namespace App\Core\Task\Presentation\Presenters;

use App\Core\Item\Presentation\ViewModels\JsonResourceViewModel;
use App\Core\Task\Application\UseCases\GetTask\GetTaskOutUseCaseInterface;
use App\Http\Resources\V1\SharedSystem\DeliveryTaskByIdResource;
use App\Http\Resources\V1\SharedSystem\DeliveryTaskResource;
use App\Http\Resources\V1\SharedSystem\OrderResource;

class GetTaskUseCaseResponse implements GetTaskOutUseCaseInterface
{
    public function show($task,$distributor)
    {
        OrderResource::using($distributor);
        return new JsonResourceViewModel(
            DeliveryTaskByIdResource::make($task->data),
        );
    }
}
