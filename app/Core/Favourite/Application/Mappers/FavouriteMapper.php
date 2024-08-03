<?php

namespace App\Core\Favourite\Application\Mappers;

use App\Concerns\BaseMapper;
use App\Core\Favourite\Domain\Entities\FavouriteEntity;
use App\Core\Favourite\Domain\Factories\FavouriteFactory;

class FavouriteMapper
{
    use BaseMapper;
    public static function fromRequest(array $request): FavouriteEntity
    {
        return  FavouriteFactory::new($request);
    }

}
