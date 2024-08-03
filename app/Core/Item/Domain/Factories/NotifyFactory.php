<?php

namespace App\Core\Item\Domain\Factories;


use App\Core\Item\Domain\Entities\NotifyEntity;

class NotifyFactory
{
    public static function new(array $attributes = null): NotifyEntity
    {
        return new NotifyEntity(
            name_en: $attributes['name_en']??'',
            name_ar: $attributes['name_ar']??'',
            tenant_id: $attributes['tenant_id']??0,
            item_id: $attributes['item_id']??0
        );
    }
}
