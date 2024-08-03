<?php

namespace App\Core\Notification\Application\UseCases\GetNotificationList;

use App\Core\Cart\Presentation\ViewModels\JsonPaginationResourceViewModel;

interface GetNotificationListOutUseCaseInterface
{
    public function index($notification):JsonPaginationResourceViewModel;
}
