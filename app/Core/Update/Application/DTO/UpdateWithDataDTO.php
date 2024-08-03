<?php

namespace App\Core\Update\Application\DTO;

use App\Concerns\BaseDTO;
use App\Core\Update\Domain\Entities\Update;
use App\Core\Update\Infrastructure\Eloquent\UpdateModel;

class UpdateWithDataDTO
{
    use BaseDTO;

    public function __construct(
        public readonly ?int $id,
        public readonly ?string $updateType,
        public readonly ?string $updateTitle,
        public readonly ?string $updateDateTime,
        public readonly ?string $updateTriggerText
    )
    {}

    public static function fromEloquent(UpdateModel $update):self{
        return new self(
            id: $update->id,
            updateType: $update->data->first(),
            updateTitle: $update->data->first(),
            updateDateTime: $update->data->first(),
            updateTriggerText: $update->data->first()
        );
    }

}
