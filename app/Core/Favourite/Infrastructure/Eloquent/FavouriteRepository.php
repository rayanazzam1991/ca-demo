<?php

namespace App\Core\Favourite\Infrastructure\Eloquent;

use App\Core\Favourite\Application\Repositories\FavouriteRepositoryInterface;
use App\Core\Favourite\Domain\Entities\FavouriteEntity;

class FavouriteRepository implements FavouriteRepositoryInterface
{

    public function index()
    {
        return FavouriteModel::where('user_id',auth()->id())->orderBy('id','desc')->get();
    }
    public function sync(FavouriteEntity $entity):bool
    {
        $favourite = FavouriteModel::where('user_id',$entity->user_id)->where('item_id',$entity->item_id,)->where('distributor_id',$entity->distributor_id)->first();
        isset($favourite)?$favourite->delete():FavouriteModel::create($entity->toArray());
        return !isset($favourite);
    }
}
