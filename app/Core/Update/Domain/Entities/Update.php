<?php

namespace App\Core\Update\Domain\Entities;

use App\Concerns\AggregateRoot;

class Update
{
    use AggregateRoot;

    public function __construct(
        public readonly ?int $id,
        public readonly ?int $update_type_id,
        public readonly ?string $update_type_type,
        public readonly ?bool $status,
    )
    {}

}
