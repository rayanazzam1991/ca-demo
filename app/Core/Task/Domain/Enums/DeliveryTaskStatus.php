<?php

namespace App\Core\Task\Domain\Enums;

enum DeliveryTaskStatus: int
{
    case PENDING = 1;
    case DONE = 2;
    case FAILED = 3;

    public static function asArray(): array
    {
        return array_map(fn($x) => $x->value, self::cases());
    }
}

