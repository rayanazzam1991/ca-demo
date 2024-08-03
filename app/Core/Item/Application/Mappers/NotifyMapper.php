<?php

namespace App\Core\Item\Application\Mappers;


use App\Core\Item\Domain\Entities\NotifyEntity;
use App\Core\Item\Domain\Factories\NotifyFactory;

class NotifyMapper
{
    public static function fromRequest($data = []): NotifyEntity
    {
        return NotifyFactory::new($data);
    }
}
