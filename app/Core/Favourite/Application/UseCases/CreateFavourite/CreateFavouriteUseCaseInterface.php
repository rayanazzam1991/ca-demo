<?php

namespace App\Core\Favourite\Application\UseCases\CreateFavourite;


use App\Core\Favourite\Domain\Entities\FavouriteEntity;

interface CreateFavouriteUseCaseInterface
{
    public function store(FavouriteEntity $entity);
}
