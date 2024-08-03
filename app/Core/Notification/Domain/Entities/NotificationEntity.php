<?php

namespace App\Core\Notification\Domain\Entities;

use App\Concerns\AggregateRoot;

class NotificationEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly ?string  $title_ar,
        public readonly ?string  $title_en,
        public readonly ?string  $description_ar,
        public readonly ?string  $description_en,
        public readonly ?string  $schedule_time,
        public readonly ?int  $type,
        public readonly ?int  $status,
        public readonly ?array  $user_ids,
        public readonly ?array  $delivery_man_ids,
        public readonly ?int  $created_by,
    ){}
}
