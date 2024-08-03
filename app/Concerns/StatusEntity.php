<?php

namespace App\Concerns;

use App\Concerns\Entity;

class StatusEntity
{
    use Entity;

    public function __construct(
        public readonly ?bool $status,
    ){}
}
