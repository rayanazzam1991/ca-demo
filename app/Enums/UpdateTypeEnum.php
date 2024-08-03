<?php

namespace App\Enums;

enum UpdateTypeEnum:int
{
    case PRICE_VARIATION = 1;
    case NEW_OFFER = 2;
    case AVAILABLE_AGAIN = 3;
    case NEW_ITEM = 4;
    case NEWS = 5;
    public static function asArray(): array
    {
        return array_map(fn($x) => $x->value, self::cases());
    }
}
