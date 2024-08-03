<?php

namespace App\Core\Notification\Domain\Entities;

use App\Concerns\AggregateRoot;

class NotificationQueueEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly ?string  $title_ar,
        public readonly ?string  $title_en,
        public readonly ?string  $body_ar,
        public readonly ?string  $body_en,
        public readonly ?int $user_type,
        public readonly ?string $mobile_number
    ){}

    public static function fromRequest($data,$user_type,$phone_number=null):NotificationQueueEntity
    {
        return new NotificationQueueEntity(
            title_ar: $data['title_ar']??'',
            title_en: $data['title_en']??'',
            body_ar: $data['description_ar']??'',
            body_en: $data['description_en']??'',
            user_type:$user_type,
            mobile_number:$phone_number
        );
    }
}
