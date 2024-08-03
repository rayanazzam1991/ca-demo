<?php

namespace App\Listeners;

use App\Core\DeliveryMan\Infrastructure\Eloquent\DeliveryManModel;
use App\Core\Notification\Domain\Entities\NotificationQueueEntity;
use App\Core\Notification\Infrastructure\Eloquent\NotificationModel;
use App\Core\Notification\Infrastructure\Eloquent\NotificationUserModel;
use App\Core\Shared\User\UserModel;
use App\Enums\NotificationStatusEnum;
use App\Enums\NotificationTypeEnum;
use App\Events\SendNotificationEvent;
use App\Jobs\SendNotificationJob;
use App\Jobs\SendNotificationToAllJob;
use App\Jobs\SyncDeliveryManImage;
use App\Models\Media;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendNotificationListener implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendNotificationEvent $event): void
    {
        $notification_model = NotificationModel::whereId($event->notification_id)->first();
        if($notification_model->type == NotificationTypeEnum::ALL_PHARMACY->value || $notification_model->type == NotificationTypeEnum::ALL->value)
            SendNotificationToAllJob::dispatch(NotificationQueueEntity::fromRequest($notification_model->toArray(),1)->toArray())->onConnection('rabbitmq');
        if($notification_model->type == NotificationTypeEnum::ALL_DELIEVERY->value || $notification_model->type == NotificationTypeEnum::ALL->value)
            SendNotificationToAllJob::dispatch(NotificationQueueEntity::fromRequest($notification_model->toArray(),2)->toArray())->onConnection('rabbitmq');
        if($notification_model->type == NotificationTypeEnum::SELECTED->value )
        {
            $user_numbers = UserModel::whereIn('id',NotificationUserModel::where('user_type',UserModel::class)->where('notification_id',$event->notification_id)->get()->pluck('user_id')->toArray())->get()->pluck('phone_number')->toArray();
            $delivery_numbers = DeliveryManModel::whereIn('id',NotificationUserModel::where('user_type',DeliveryManModel::class)->where('notification_id',$event->notification_id)->get()->pluck('user_id')->toArray())->get()->pluck('phone_number')->toArray();
            foreach ($user_numbers as $number)
                    SendNotificationJob::dispatch(NotificationQueueEntity::fromRequest($notification_model->toArray(),1,$number)->toArray())->onConnection('rabbitmq');
            foreach ($delivery_numbers as $number)
                SendNotificationJob::dispatch(NotificationQueueEntity::fromRequest($notification_model->toArray(),2,$number)->toArray())->onConnection('rabbitmq');
        }
        $notification_model->update(['status' => NotificationStatusEnum::SENT->value]);
    }
}
