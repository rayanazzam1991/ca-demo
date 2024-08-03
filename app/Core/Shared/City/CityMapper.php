<?php

namespace App\Core\Shared\City;

use App\Concerns\BaseMapper;
class CityMapper
{
    use BaseMapper;
    public static function fromRequest(array $request):CityEntity
    {
        return CityFactory::new($request);
    }
}
