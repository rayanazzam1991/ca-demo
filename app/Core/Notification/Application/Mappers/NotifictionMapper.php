<?php

namespace App\Core\Notification\Application\Mappers;

use App\Core\Notification\Domain\Entities\NotificationEntity;
use App\Core\Notification\Domain\Factories\NotificationFactory;

class NotifictionMapper
{
    public static function fromRequest(array $request): NotificationEntity
    {
        return NotificationFactory::new($request);
    }
}
