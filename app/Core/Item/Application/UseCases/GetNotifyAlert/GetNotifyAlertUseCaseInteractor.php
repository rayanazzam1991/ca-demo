<?php

namespace App\Core\Item\Application\UseCases\GetNotifyAlert;

use App\Core\Distributor\Application\Repositories\DistributorRepositoryInterface;
use App\Core\Distributor\Infrastructure\Eloquent\DistributorModel;
use App\Core\Item\Application\Repositories\GetItemGateWayRepositoryInterface;
use App\Core\Item\Domain\Entities\NotifyEntity;
use App\Core\Notification\Application\Mappers\NotifictionMapper;
use App\Core\Notification\Application\Repositories\NotificationRepositoryInterface;
use App\Core\Reminder\Infrastructure\Eloquent\ReminderModel;
use App\Core\Tenant\Application\Repositories\TenantRepositoryInterface;
use App\Enums\NotificationStatusEnum;
use App\Enums\NotificationTypeEnum;
use App\Events\SendNotificationEvent;

class GetNotifyAlertUseCaseInteractor implements GetNotifyAlertUseCaseInterface
{
    public function __construct(private readonly NotificationRepositoryInterface $notificationRepository
    ){}

    public function getNotifyAlert(NotifyEntity $entity):void
    {
        $distributor_id = DistributorModel::where('tenant_id',$entity->tenant_id)->first()->id;
        $user_ids = ReminderModel::where('distributor_id',$distributor_id)->where('item_id',$entity->item_id)->get()->pluck('user_id')->toArray();
        if(count($user_ids) > 0)
        {
            $notification_model = $this->notificationRepository->store(NotifictionMapper::fromRequest([
                'title_ar' => "توفرت مادة مجدداً",
                'title_en' => "An item is available again",
                'description_ar' => " توفرت المادة مجدداً ".$entity->name_ar,
                'description_en' => $entity->name_en." Item is available again ",
                'type' => NotificationTypeEnum::SELECTED->value,
                'status' => NotificationStatusEnum::NOT_SENT->value,
                'user_ids' => $user_ids,
            ]));
            SendNotificationEvent::dispatch($notification_model->id);
        }
    }
}
