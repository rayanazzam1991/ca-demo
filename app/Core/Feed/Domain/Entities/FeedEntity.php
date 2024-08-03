<?php

namespace App\Core\Feed\Domain\Entities;

use App\Concerns\AggregateRoot;
use App\Core\Shared\Address\AddressEntity;
use App\Core\Tenant\Domain\Entities\TenantEntity;
use App\Models\Media;
use Illuminate\Http\UploadedFile;

class FeedEntity
{
    use AggregateRoot;
    public function __construct(
        public readonly ?int    $id,
        public readonly ?string $title_ar,
        public readonly ?string $title_en,
        public readonly ?string $description,
        public readonly ?int $created_by,
        public readonly ?UploadedFile $image,
    ){}
}
