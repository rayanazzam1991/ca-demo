<?php

namespace App\Core\Update\Application\Mappers;

use App\Concerns\BaseMapper;
use App\Core\Update\Domain\Entities\Update;
use App\Core\Update\Domain\Factories\CreateUpdateFactory;

class UpdateMapper
{
    use BaseMapper;

    public static function fromRequest(array $request): Update
    {
        return CreateUpdateFactory::new($request);
    }

}
