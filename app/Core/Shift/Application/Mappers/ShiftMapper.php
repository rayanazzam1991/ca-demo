<?php

namespace App\Core\Shift\Application\Mappers;

use App\Concerns\BaseMapper;
use App\Core\Shift\Domain\Factories\ShiftFactory;

class ShiftMapper
{
    use BaseMapper;
    public static function fromRequest(array $request)
    {
        $collection = collect();
        foreach ($request['shifts'] as $value)
            $collection->push(ShiftFactory::new($value));
        return $collection;
    }
}
