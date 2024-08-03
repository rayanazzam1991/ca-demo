<?php

namespace App\Core\Favourite\Presentation\Presenters;

use App\Core\Favourite\Application\UseCases\GetFavouriteListUseCase\GetFavouriteListOutputUseCaseInterface;
use App\Core\Update\Presentation\ViewModels\JsonResourceViewModel;
use App\Http\Resources\V1\SharedSystem\ItemResource;

class GetFavouriteListUseCaseResponse implements GetFavouriteListOutputUseCaseInterface
{
    public function getList($favourites,$distributor,$order=null)
    {
        $favourites = (isset($order))
        ?collect($favourites->data)->sortBy(function($model) use ($order){
            return array_search($model->id, $order);
        }):$favourites->data;
        ItemResource::using(['distributor'=>$distributor]);
        return new JsonResourceViewModel(ItemResource::collection($favourites));
    }
}
