<?php

namespace App\Core\Shared\Region;

use App\Concerns\BaseMapper;
class RegionMapper
{
    use BaseMapper;
    public static function fromRequest(array $request):RegionEntity
    {
        return RegionFactory::new($request);
    }
}
