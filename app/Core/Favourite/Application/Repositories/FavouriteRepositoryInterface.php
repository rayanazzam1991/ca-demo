<?php

namespace App\Core\Favourite\Application\Repositories;

use App\Core\Favourite\Domain\Entities\FavouriteEntity;
use App\Core\Favourite\Infrastructure\Eloquent\FavouriteModel;

interface FavouriteRepositoryInterface
{
    public function index();
    public function sync(FavouriteEntity $entity):bool;
}
