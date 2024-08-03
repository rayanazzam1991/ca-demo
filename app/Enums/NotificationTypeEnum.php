<?php

namespace App\Enums;

enum NotificationTypeEnum: int
{
    case ALL = 0;
    case ALL_PHARMACY = 1;
    case ALL_DELIEVERY = 2;
    case SELECTED = 3;

    public static function asArray(): array
    {
        return array_map(fn($x) => $x->value, self::cases());
    }
}
