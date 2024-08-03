<?php

namespace App\Core\Notification\Domain\Factories;

use App\Core\Notification\Domain\Entities\InformNotificationEntity;

class InformNotificationFactory
{
    public static function new(array $attributes = null): InformNotificationEntity
    {
        return new InformNotificationEntity(
            notification: $attributes['notification'],
            user: $attributes['user'],
        );
    }
}
