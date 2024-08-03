<?php

namespace App\Enums;

enum MediaModelsEnum:String
{
    case banner = "banner";
    case item = "item";
    case feed = "feed";
    case distributor = "distributor";
    case deliveryMan = "deliveryMan";
    case user = "user";
    case manufacturer = "manufacturer";

    public static function asArray(): array
    {
        return array_map(fn($x) => $x->value, self::cases());
    }
}
