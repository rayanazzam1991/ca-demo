<?php

namespace App\Core\Notification\Infrastructure\Eloquent;

use App\Core\Notification\Application\Filter\NotificationFilter;
use App\Core\DeliveryMan\Infrastructure\Eloquent\DeliveryManModel;
use App\Core\Notification\Application\Repositories\NotificationRepositoryInterface;
use App\Core\Notification\Domain\Entities\NotificationEntity;
use App\Core\Shared\User\UserModel;
use App\Enums\NotificationTypeEnum;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;


class NotificationRepository implements NotificationRepositoryInterface
{
    public function index(NotificationFilter $filter):LengthAwarePaginator
    {
        return NotificationModel::query()
        ->when($filter->user_ids,function ($q)use($filter){
            return $q->where(function($query)use($filter){
                return $query->where('type',NotificationTypeEnum::SELECTED->value)->whereHas('users',function($query) use($filter){
                    return $query->where('user_type',UserModel::class)->whereIn('user_id',$filter->user_ids);
                });
            })->orWhere('type',NotificationTypeEnum::ALL->value)->orWhere('type',NotificationTypeEnum::ALL_PHARMACY->value);
        })
        ->when($filter->deliveryMan_ids,function ($q)use($filter){
            return $q->where(function($query)use($filter){
                return $query->where('type',NotificationTypeEnum::SELECTED->value)->whereHas('users',function($query) use($filter){
                    return $query->where('user_type',UserModel::class)->whereIn('user_id',$filter->deliveryMan_ids);
                });
            })->orWhere('type',NotificationTypeEnum::ALL->value)->orWhere('type',NotificationTypeEnum::ALL_DELIEVERY->value);
        })
        ->when($filter->notification_status,function ($q)use($filter){
            return $q->where('status',$filter->notification_status);
        })
        ->when(($filter->schedule_date_from && $filter->schedule_date_to),function ($q)use($filter){
            return $q->whereBetween('schedule_time',[Carbon::make($filter->schedule_date_from)->toDateTime(),Carbon::make($filter->schedule_date_to)->toDateTime()]);
        })
        ->when(isset($filter->order),function ($q)use($filter){
            return $q->orderBy('id',$filter->order);
        })
        ->paginate($filter->per_page);
    }

    public function store(NotificationEntity $entity):NotificationModel
    {
        $notification = NotificationModel::create($entity->toArray());
        if($entity->type != NotificationTypeEnum::ALL->value)
        {
            foreach ($entity->user_ids as $value)
                NotificationUserModel::create(['notification_id'=>$notification->id,'user_type'=>UserModel::class,'user_id'=>$value]);
            foreach ($entity->delivery_man_ids as $value)
                NotificationUserModel::create(['notification_id'=>$notification->id,'user_type'=>DeliveryManModel::class,'user_id'=>$value]);
        }
        return  $notification;
    }
}
