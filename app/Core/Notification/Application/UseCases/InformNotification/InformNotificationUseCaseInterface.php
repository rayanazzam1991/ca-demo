<?php
namespace App\Core\Notification\Application\UseCases\InformNotification;

use App\Core\Notification\Domain\Entities\InformNotificationEntity;
use App\Core\Notification\Domain\Entities\NotificationEntity;

interface InformNotificationUseCaseInterface
{
    public function inform(InformNotificationEntity $entity);
}
