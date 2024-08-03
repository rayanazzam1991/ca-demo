<?php

namespace App\Core\Shared\City;

use App\Concerns\StatusEntity;
use Illuminate\Pagination\LengthAwarePaginator;


class CityRepository implements CityRepositoryInterface
{
    public function index(CityFilter $filter):LengthAwarePaginator
    {

        return CityModel::query()
            ->when($filter->search,function ($q)use($filter){
                return $q
                    ->where('name_en','like','%'.$filter->search.'%')
                    ->orWhere('name_ar','like','%'.$filter->search.'%')
                    ->orWhere('id','like','%'.$filter->search.'%');
            })
            ->when($filter->name,function($q)use($filter){
                return $q->where('name_en','like','%'.$filter->name.'%')->orwhere('name_ar','like','%'.$filter->name.'%');
            })
            ->when(isset($filter->status),function ($q)use($filter){
                return $q->where('status',$filter->status);
            })
            ->when($filter->order,function ($q)use($filter){
                return $q->orderBy('created_at',$filter->order);
            })
            ->paginate($filter->per_page);
    }

    public function show(int $id):CityModel
    {
        return CityModel::query()->whereId($id)->firstOrFail();
    }

    public function store(CityEntity $entity):CityModel
    {
        return CityModel::create(array_filter($entity->toArray(), function ($value) {return $value !== null;}));
    }
    public function update(CityEntity $entity,int $id):CityModel
    {
        $city =CityModel::query()->whereId($id)->firstOrFail();
        $city->update(array_filter($entity->toArray(), function ($value) {return $value !== null;}));
        return $city;
    }

    public function changeStatus(StatusEntity $entity,int $id):CityModel
    {
        $city =CityModel::query()->whereId($id)->firstOrFail();
        $city->update($entity->toArray());
        return $city;
    }
}
