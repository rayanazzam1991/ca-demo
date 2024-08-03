<?php

namespace App\Concerns;

use App\Concerns\Entity;

class BaseFilter
{
    public function __construct(
        public readonly ?int $per_page,
        public readonly ?int $page,
        public readonly ?string $search,
        public readonly ?int $status,
        public readonly ?bool $all = false,
    ){}
}
