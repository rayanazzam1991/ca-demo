<?php

namespace App\Enums;

enum UserTypeEnum: int
{

    case pharmacy = 0;
    case delivery = 1;

    public static function asArray(): array
    {
        return array_map(fn($x) => $x->value, self::cases());
    }
}
