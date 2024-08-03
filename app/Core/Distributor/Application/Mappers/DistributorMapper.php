<?php

namespace App\Core\Distributor\Application\Mappers;

use App\Concerns\BaseMapper;
use App\Core\Distributor\Domain\Entities\DistributorEntity;
use App\Core\Distributor\Domain\Factories\DistributorFactory;


class DistributorMapper
{
    use BaseMapper;

    public static function fromRequest(array $request,$image=null):DistributorEntity
    {
        return DistributorFactory::new($request,$image);
    }

}
