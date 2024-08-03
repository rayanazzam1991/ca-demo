<?php

namespace App\Enums;

enum GeneralEnum: int
{
    case active = 1;
    case inActive = 0;

    public static function asArray(): array
    {
        return array_map(fn($x) => $x->value, self::cases());
    }
}
