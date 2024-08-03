<?php

namespace App\Core\Order\Domain\Factories;

use App\Core\Order\Domain\Entities\ReturnOrderEntity;

class ReturnOrderFactory
{
    public static function new(array $attributes = null): ReturnOrderEntity
    {
        return new ReturnOrderEntity(
            order_id: $attributes['order_id']??0,
            distributor_id: $attributes['distributor_id']??0,
            reason: $attributes['reason']??'',
        );
    }
}
