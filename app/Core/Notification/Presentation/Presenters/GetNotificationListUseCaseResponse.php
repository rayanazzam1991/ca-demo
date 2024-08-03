<?php

namespace App\Core\Notification\Presentation\Presenters;

use App\Core\Cart\Presentation\ViewModels\JsonPaginationResourceViewModel;
use App\Core\Notification\Application\UseCases\GetNotificationList\GetNotificationListOutUseCaseInterface;
use App\Core\Order\Application\UseCases\GetList\GetOrderListOutputUseCaseInterface;
use App\Core\Update\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\PaginationResource;
use App\Http\Resources\V1\Notification\NotificationResource;

class GetNotificationListUseCaseResponse implements GetNotificationListOutUseCaseInterface
{
    public function index($notification):JsonPaginationResourceViewModel
    {
        return new JsonPaginationResourceViewModel(
            NotificationResource::collection($notification),
            PaginationResource::make($notification)
        );
    }
}
