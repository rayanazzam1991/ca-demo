<?php

namespace App\Enums;

enum GenderEnum: int
{
    case MALE = 1;
    case FEMALE = 2;

    public static function asArray(): array
    {
        return array_map(fn($x) => $x->value, self::cases());
    }
}
