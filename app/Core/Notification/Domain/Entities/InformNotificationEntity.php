<?php

namespace App\Core\Notification\Domain\Entities;

use App\Concerns\AggregateRoot;

class InformNotificationEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly array  $notification,
        public readonly array  $user,
    ){}
}
