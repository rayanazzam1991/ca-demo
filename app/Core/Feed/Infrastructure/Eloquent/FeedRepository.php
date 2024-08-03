<?php

namespace App\Core\Feed\Infrastructure\Eloquent;

use App\Concerns\StatusEntity;
use App\Core\Feed\Application\Filter\FeedFilter;
use App\Core\Feed\Application\Repositories\FeedRepositoryInterface;
use App\Core\Feed\Domain\Entities\FeedEntity;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;

class FeedRepository implements FeedRepositoryInterface
{
    public function index(FeedFilter $filter):LengthAwarePaginator
    {
        return FeedModel::with('medias')
        ->when($filter->search,function ($q)use($filter){
            return $q
            ->where('title_en','like','%'.$filter->search.'%')
            ->orWhere('title_ar','like','%'.$filter->search.'%')
            ->orWhere('id','like','%'.$filter->search.'%');
        })
        ->when($filter->title_ar,function ($q)use($filter){
            return $q->where('name_ar','like','%'.$filter->title_ar.'%');
        })
        ->when($filter->title_en,function ($q)use($filter){
            return $q->where('name_en','like','%'.$filter->title_ar.'%');
        })
        ->when(isset($filter->status),function ($q)use($filter){
            return $q->where('status',$filter->status);
        })
        ->when(isset($filter->order),function ($q)use($filter){
            return $q->orderBy('created_at',$filter->order);
        })
        ->when(($filter->start_date && $filter->end_date),function($q)use($filter){
            return $q->whereBetween('created_at', [Carbon::make($filter->start_date)->format('Y-m-d')." 00:00:00", Carbon::make($filter->end_date)->format('Y-m-d')." 23:59:59"]);

        })
        ->paginate($filter->per_page);
    }

    public function get(FeedFilter $filter)
    {
        return FeedModel::with('medias')
            ->when($filter->search,function ($q)use($filter){
                return $q
                    ->where('title_en','like','%'.$filter->search.'%')
                    ->orWhere('title_ar','like','%'.$filter->search.'%')
                    ->orWhere('id','like','%'.$filter->search.'%');
            })
            ->when($filter->title_ar,function ($q)use($filter){
                return $q->where('name_ar','like','%'.$filter->title_ar.'%');
            })
            ->when($filter->title_en,function ($q)use($filter){
                return $q->where('name_en','like','%'.$filter->title_ar.'%');
            })
            ->when(isset($filter->status),function ($q)use($filter){
                return $q->where('status',$filter->status);
            })
            ->when(isset($filter->order),function ($q)use($filter){
                return $q->orderBy('created_at',$filter->order);
            })
            ->when(($filter->start_date && $filter->end_date),function($q)use($filter){
                return $q->whereBetween('created_at', [Carbon::make($filter->start_date)->format('Y-m-d')." 00:00:00", Carbon::make($filter->end_date)->format('Y-m-d')." 23:59:59"]);

            })
            ->get();
    }

    public function show(int $id):FeedModel
    {
        return FeedModel::query()->with('medias')->whereId($id)->firstOrFail();
    }
    public function store(FeedEntity $entity):FeedModel
    {
        return FeedModel::create($entity->toArray());
    }

    public function update(FeedEntity $entity,int $id):FeedModel
    {
        $feed =FeedModel::where('id',$id)->firstOrFail();
        $feed->update($entity->toArray());
        return $feed;
    }

    public function changeStatus(int $id,StatusEntity $entity):void
    {
        $feed = FeedModel::whereId($id)->firstOrFail();
        $feed->update($entity->toArray());
    }
}
