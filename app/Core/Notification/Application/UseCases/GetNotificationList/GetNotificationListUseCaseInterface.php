<?php
namespace App\Core\Notification\Application\UseCases\GetNotificationList;
use App\Core\Notification\Application\Filter\NotificationFilter;

interface GetNotificationListUseCaseInterface
{
    public function index(NotificationFilter $filter);
}
