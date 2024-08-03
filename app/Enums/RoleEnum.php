<?php

namespace App\Enums;

enum RoleEnum:string
{
    case Admin = "admin";
    case Pharmacy = "pharmacy";
    public static function asArray(): array
    {
        return array_map(fn($x) => $x->value, self::cases());
    }
}
