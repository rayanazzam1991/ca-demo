<?php

namespace App\Core\Order\Application\Filter;

use App\Concerns\BaseFilter;

class OrderFilter
{
    public function __construct(
        public readonly ?int   $distributor_id,
        public readonly ?array $orders_id,
    ){}

    public static function fromRequest(array $request): OrderFilter
    {
        return new OrderFilter(
            distributor_id: $request['distributor_id']??null,
            orders_id: $request['orders_id']??[]
        );
    }
}
