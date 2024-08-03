<?php
namespace App\Core\Notification\Application\UseCases\CreateNotification;

use App\Core\Notification\Domain\Entities\NotificationEntity;

interface CreateNotificationUseCaseInterface
{
    public function store(NotificationEntity $entity);
}
