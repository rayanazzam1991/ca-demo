<?php

namespace App\Enums;

enum NotificationStatusEnum: int
{
    case SENT = 0;
    case NOT_SENT = 1;
    case SCHEDULE = 2;

    public static function asArray(): array
    {
        return array_map(fn($x) => $x->value, self::cases());
    }
}
