<?php

namespace App\Core\Order\Domain\Entities;

use App\Concerns\AggregateRoot;

class ReturnOrderEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly ?int $order_id,
        public readonly ?int $distributor_id,
        public readonly ?string $reason,
    ){}
}
