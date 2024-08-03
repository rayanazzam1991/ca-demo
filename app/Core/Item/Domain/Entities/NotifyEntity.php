<?php

namespace App\Core\Item\Domain\Entities;

use App\Concerns\AggregateRoot;

class NotifyEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly ?string  $name_en,
        public readonly ?string  $name_ar,
        public readonly ?int  $tenant_id,
        public readonly ?int  $item_id,
    ){}
}
