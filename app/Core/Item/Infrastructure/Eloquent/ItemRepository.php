<?php

namespace App\Core\Item\Infrastructure\Eloquent;

use App\Core\Item\Application\Filter\ItemFilter;
use App\Core\Item\Application\Repositories\ItemRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ItemRepository implements ItemRepositoryInterface
{
    public function getList(ItemFilter $itemFilter):LengthAwarePaginator
   {
        return ItemModel::query()
        ->when($itemFilter->type_id,function (Builder $query)use($itemFilter){
            $query->whereHas('types',function (Builder $q)use($itemFilter){
                return $q->where('type_id',$itemFilter->type_id);
            });
        })->when($itemFilter->distributor_id,function (Builder $query)use($itemFilter){
            return $query->where('distributor_id',$itemFilter->distributor_id);
        })->paginate($itemFilter->per_page);
   }

    public function getOne(int $id):ItemModel
    {
        return ItemModel::query()->with('distributor')->whereId($id)->firstOrFail();
    }

   public function show(int $id):Model
   {
       return ItemModel::query()->whereId($id)->firstOrFail();
   }
}
