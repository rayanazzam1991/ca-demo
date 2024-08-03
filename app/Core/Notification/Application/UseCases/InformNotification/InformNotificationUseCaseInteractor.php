<?php

namespace App\Core\Notification\Application\UseCases\InformNotification;

use App\Core\Notification\Domain\Entities\InformNotificationEntity;
use App\Core\Shared\User\UserModel;
use App\Enums\RoleEnum;
use App\Events\NotificationSenderPusherEvent;
use Illuminate\Support\Facades\Log;

class InformNotificationUseCaseInteractor implements InformNotificationUseCaseInterface
{
  public function __construct()
  {
  }

  public function inform(InformNotificationEntity $entity): void
  {

    if (array_key_exists('user_type', $entity->user) && $entity->user['user_type'] == 1 && array_key_exists('mobile_number', $entity->user)) {
      $userWithPharmacy = UserModel::with(['pharmacy', 'pharmacy.address', 'medias', 'pharmacy.shifts'])
        ->whereHas('roles', function ($q) {
          return $q->where('name', RoleEnum::Pharmacy->value);
        })->where('phone_number', $entity->user['mobile_number'])->first();
      if ($userWithPharmacy) {
        broadcast(new NotificationSenderPusherEvent($entity->notification, $userWithPharmacy->id, $userWithPharmacy->lang));
      }
    }
  }
}
