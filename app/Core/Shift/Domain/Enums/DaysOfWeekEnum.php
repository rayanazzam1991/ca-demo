<?php

namespace App\Core\Shift\Domain\Enums;

enum DaysOfWeekEnum: int
{
    case SUNDAY = 0;
    case MONDAY = 1;
    case TUESDAY = 2;
    case WEDNESDAY = 3;
    case THURSDAY = 4;
    case FRIDAY = 5;
    case SATURDAY = 6;

    public static function asArray(): array
    {
        return array_map(fn($x) => $x->value, self::cases());
    }
}

