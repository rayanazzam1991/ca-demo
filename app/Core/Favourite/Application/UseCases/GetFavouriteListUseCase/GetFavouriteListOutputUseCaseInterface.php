<?php

namespace App\Core\Favourite\Application\UseCases\GetFavouriteListUseCase;

interface GetFavouriteListOutputUseCaseInterface
{
    public function getList($favourites,$distributor,$order);
}
