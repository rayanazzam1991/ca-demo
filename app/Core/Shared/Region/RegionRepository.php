<?php

namespace App\Core\Shared\Region;

use App\Concerns\StatusEntity;
use App\Core\Shared\City\CityModel;
use Illuminate\Pagination\LengthAwarePaginator;


class RegionRepository implements RegionRepositoryInterface
{
    public function index(RegionFilter $filter):LengthAwarePaginator
    {

        return RegionModel::query()->with(['city','parentRegion'])
            ->when($filter->search,function ($q)use($filter){
                return $q
                    ->where('name_en','like','%'.$filter->search.'%')
                    ->orWhere('name_ar','like','%'.$filter->search.'%')
                    ->orWhere('id','like','%'.$filter->search.'%');
            })
            ->when($filter->name,function($q)use($filter){
                return $q->where('name_en','like','%'.$filter->name.'%')->orwhere('name_ar','like','%'.$filter->name.'%');
            })
            ->when($filter->city_id,function($q)use($filter){
                return $q->where('city_id',$filter->city_id);
            })
            ->when($filter->parent_region_id,function($q)use($filter){
                return $q->where('parent_region_id',$filter->parent_region_id);
            })
            ->when($filter->sub_region_id,function($q)use($filter){
                return $q->where('parent_region_id',$filter->sub_region_id);
            })
            ->when(isset($filter->is_parent),function ($q)use($filter){
                return $q->where('parent_region_id',null);
            })
            ->when(isset($filter->is_not_parent),function ($q)use($filter){
                return $q->where('parent_region_id','!=',null);
            })
            ->when(isset($filter->status),function ($q)use($filter){
                return $q->where('status',$filter->status);
            })
            ->when($filter->order,function ($q)use($filter){
                return $q->orderBy('created_at',$filter->order);
            })
            ->paginate($filter->per_page);
    }

    public function show(int $id):RegionModel
    {
        return RegionModel::query()->with(['city','parentRegion'])->whereId($id)->firstOrFail();
    }

    public function store(RegionEntity $entity):RegionModel
    {
        $city_id =isset($entity->city_id)?$entity->city_id: RegionModel::whereId($entity->parent_region_id)->first()->city_id;
         return RegionModel::create(array_merge($entity->toArray(),['city_id'=>$city_id,'status'=>1]));
    }
    public function update(RegionEntity $entity,int $id):RegionModel
    {
        $city_id =isset($entity->city_id)?$entity->city_id: RegionModel::whereId($entity->parent_region_id)->first()->city_id;
        $region = RegionModel::query()->whereId($id)->firstOrFail();
        $region->update(array_merge(['city_id'=>$city_id],array_filter($entity->toArray(), function ($value) {return $value !== null;})));

        return $region;
    }

    public function changeStatus(StatusEntity $entity,int $id):RegionModel
    {
        $region = RegionModel::query()->whereId($id)->firstOrFail();
       $region->update($entity->toArray());
       return $region;
    }

}
