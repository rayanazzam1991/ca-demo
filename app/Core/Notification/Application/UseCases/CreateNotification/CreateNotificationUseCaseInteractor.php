<?php

namespace App\Core\Notification\Application\UseCases\CreateNotification;

use App\Core\DeliveryMan\Infrastructure\Eloquent\DeliveryManModel;
use App\Core\Notification\Application\Repositories\NotificationRepositoryInterface;
use App\Core\Notification\Application\Repositories\SyncFcmGateWayRepositoryInterface;
use App\Core\Notification\Domain\Entities\NotificationEntity;
use App\Enums\NotificationStatusEnum;
use App\Events\SendNotificationEvent;


class CreateNotificationUseCaseInteractor implements CreateNotificationUseCaseInterface
{
    public function __construct(
      private readonly NotificationRepositoryInterface $notificationRepository,
    ){}

    public function store(NotificationEntity $entity):void
    {
        $notification_model = $this->notificationRepository->store($entity);
        if($notification_model->status != NotificationStatusEnum::SCHEDULE->value)
        SendNotificationEvent::dispatch($notification_model->id);
    }
}
