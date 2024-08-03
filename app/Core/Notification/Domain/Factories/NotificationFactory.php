<?php

namespace App\Core\Notification\Domain\Factories;

use App\Core\Notification\Domain\Entities\NotificationEntity;
use App\Enums\NotificationStatusEnum;
use App\Enums\NotificationTypeEnum;

class NotificationFactory
{
    public static function new(array $attributes = null): NotificationEntity
    {
        return new NotificationEntity(
            title_ar: $attributes['title_ar']??'',
            title_en: $attributes['title_en']??'',
            description_ar: $attributes['description_ar']??'',
            description_en: $attributes['description_en']??'',
            schedule_time: $attributes['schedule_time']??null,
            type: $attributes['type']??NotificationTypeEnum::ALL->value,
            status: $attributes['status']??NotificationStatusEnum::NOT_SENT->value,
            user_ids: $attributes['user_ids']??[],
            delivery_man_ids: $attributes['delivery_man_ids']??[],
            created_by: auth()->id()??1,
        );
    }
}
