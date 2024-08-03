<?php

namespace App\Core\Notification\Domain\Entities;

use App\Concerns\AggregateRoot;

class FcmEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly ?string  $fcm_token,
        public readonly ?string  $lang,
        public readonly ?string $mobile_number,
        public readonly ?int $user_type,

    ){}

    public static function fromRequest($fcm_token,$lang,$mobile_number,$user_type):FcmEntity
    {
        return new FcmEntity(
            fcm_token:$fcm_token,
            lang:$lang??'ar',
            mobile_number:$mobile_number,
            user_type: $user_type
        );
    }
}
