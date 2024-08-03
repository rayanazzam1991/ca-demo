<?php

namespace App\Core\Order\Domain\Entities;

use App\Concerns\AggregateRoot;

class OrderEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly ?int $client_id,
        public readonly ?string $phone_number,
        public readonly ?int $client_group_id,
        public readonly ?int $warehouse_id,
        public readonly ?string $payment_method_code,
        public readonly ?int $discount,
        public readonly ?string $note,
        public readonly ?array $items
    ){}
}
