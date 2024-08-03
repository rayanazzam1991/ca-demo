<?php

namespace App\Core\Notification\Application\UseCases\GetUserNotificationList;

use App\Core\Notification\Application\Repositories\GetNotificationListGateWayRepositoryInterface;

class GetUserNotificationListUseCaseInteractor implements GetUserNotificationListUseCaseInterface
{
    public function __construct(
      private readonly GetNotificationListGateWayRepositoryInterface $notificationRepository,
    ){}

    public function index($phone_number,$user_type)
    {
        return $this->notificationRepository->index($phone_number,$user_type)['data']??[];
    }
}
