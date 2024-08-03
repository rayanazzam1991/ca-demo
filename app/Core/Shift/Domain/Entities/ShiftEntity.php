<?php

namespace App\Core\Shift\Domain\Entities;

use App\Concerns\AggregateRoot;

class ShiftEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly int $pharmacy_id,
        public readonly int $day_of_week,
        public readonly string $start_time,
        public readonly string $end_time,
    ){}
}
