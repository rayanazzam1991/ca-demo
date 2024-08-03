<?php

namespace App\Core\ActivityLog\Presentation\Presenters;

use App\Core\ActivityLog\Application\UseCases\GetActivityLogList\GetActivityLogOutputUseCaseInterface;
use App\Core\Feed\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\V1\ActivityLog\ActivityLogListResource;

class GetActivityLogUseCaseResponse implements GetActivityLogOutputUseCaseInterface
{
    public function index($logs)
    {
        return new JsonPaginationResourceViewModel(
            ActivityLogListResource::collection($logs),
            PaginationResource::make($logs),
        );
    }
}
