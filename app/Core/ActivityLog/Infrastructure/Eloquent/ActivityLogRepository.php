<?php

namespace App\Core\ActivityLog\Infrastructure\Eloquent;

use App\Core\ActivityLog\Application\Repositories\ActivityLogRepositoryInterface;
use App\Core\ActivityLog\Application\Filter\ActivtyLogFilter;


class ActivityLogRepository implements ActivityLogRepositoryInterface
{
    public function index(ActivtyLogFilter $filter)
    {
        return ActivityLog::query()
        ->when($filter->search,function ($q)use($filter){
            return $q
                ->where('subject_name_ar','like','%'.$filter->search.'%')
                ->orWhere('subject_name_en','like','%'.$filter->search.'%')
                ->orWhere('id','like','%'.$filter->search.'%');
        })
        ->when($filter->order,function ($q)use($filter){
            return $q->orderBy('created_at',$filter->order);
        })
        ->when($filter->user_id,function ($q)use($filter){
            return $q->where('causer_id',$filter->user_id);
        })
        ->paginate($filter->per_page);
    }
}
