<?php

namespace App\Core\Notification\Application\UseCases\GetNotificationList;
use App\Core\Notification\Application\Filter\NotificationFilter;
use App\Core\Notification\Application\Repositories\NotificationRepositoryInterface;

class GetNotificationListUseCaseInteractor implements GetNotificationListUseCaseInterface
{
    public function __construct(
      private readonly NotificationRepositoryInterface $notificationRepository,
      private readonly GetNotificationListOutUseCaseInterface $outUseCase
    ){}

    public function index(NotificationFilter $filter)
    {
        return $this->outUseCase->index($this->notificationRepository->index($filter));
    }
}
