<?php

namespace App\Core\Update\Domain\ValueObjects;

use App\Concerns\ValueObject;

final class UpdateContent extends ValueObject
{

    public function __construct(
        public readonly ?int $update_type_id,
        public readonly ?string $update_type_type,
    )
    {}

    public function jsonSerialize(): mixed
    {
        // TODO: Implement jsonSerialize() method.
    }
}
