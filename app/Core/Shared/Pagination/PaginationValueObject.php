<?php

namespace App\Core\Shared\Pagination;

class PaginationValueObject
{
    public function __construct(
        public readonly ?int $total,
        public readonly ?int $count,
        public readonly ?int $per_page,
        public readonly ?int $page,
        public readonly ?int $max_page,
    )
    {
    }
}

