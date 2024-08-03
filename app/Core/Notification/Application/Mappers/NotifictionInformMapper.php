<?php

namespace App\Core\Notification\Application\Mappers;

use App\Core\Notification\Domain\Entities\InformNotificationEntity;
use App\Core\Notification\Domain\Entities\NotificationEntity;
use App\Core\Notification\Domain\Factories\InformNotificationFactory;
use App\Core\Notification\Domain\Factories\NotificationFactory;

class NotifictionInformMapper
{
    public static function fromRequest(array $request): InformNotificationEntity
    {
        return InformNotificationFactory::new($request);
    }
}
