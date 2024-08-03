<?php

namespace App\Core\Update\Application\DTO;

use App\Concerns\BaseDTO;
use App\Core\Shared\Pagination\PaginationMapper;
use App\Core\Shared\Pagination\PaginationValueObject;
use App\Core\Update\Infrastructure\Eloquent\UpdateModel;
use Illuminate\Pagination\LengthAwarePaginator;

class UpdateWithPaginatedDataDTO
{
    use BaseDTO;

    public function __construct(
        public readonly ?int                   $id,
        public readonly ?string                $updateType,
        public readonly ?string                $updateTitle,
        public readonly ?string                $updateDateTime,
        public readonly ?string                $updateTriggerText,
        public readonly ?PaginationValueObject $pagination
    )
    {
    }

    public static function fromEloquent($updateWithPagination): self
    {

        $itemsTransformed = $updateWithPagination
            ->getCollection()
            ->first()
            ->toArray();
        return new self(
            id: $itemsTransformed['id'],
            updateType: $itemsTransformed['id'],
            updateTitle: $itemsTransformed['id'],
            updateDateTime: $itemsTransformed['id'],
            updateTriggerText: $itemsTransformed['id'],
            pagination: PaginationMapper::fromEloquent($updateWithPagination)
        );
    }

}
