<?php

namespace App\Core\Task\Application\Mappers;

use App\Core\Task\Domain\Entities\RearrangeTasksEntity;
use App\Core\Task\Domain\Factories\RearrangeTasksFactory;

class RearrangeTasksMapper
{
    public static function fromRequest(array $request): RearrangeTasksEntity
    {
        return RearrangeTasksFactory::new($request);
    }
}
