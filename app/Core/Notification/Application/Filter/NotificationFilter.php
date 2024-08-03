<?php

namespace App\Core\Notification\Application\Filter;

use App\Concerns\BaseFilter;

class NotificationFilter extends BaseFilter
{
    public function __construct(
        ?int $per_page,
        ?int $page,
        ?string $search,
        ?int   $status,
        public readonly ?string  $schedule_date_from,
        public readonly ?string  $schedule_date_to,
        public readonly ?string  $notification_status,
        public readonly ?array $user_ids,
        public readonly ?array $deliveryMan_ids,
        public readonly ?string  $order,
    ){parent::__construct($per_page,$page,$search,$status);}

    public static function fromRequest(array $request): NotificationFilter
    {
        return new NotificationFilter(
            per_page: $request["per_page"] ?? 100,
            page: $request["page"] ?? 1,
            search: $request["search"] ?? null,
            status: $request['status']??null,
            schedule_date_from: $request['schedule_date_from']??null,
            schedule_date_to: $request['schedule_date_to']??null,
            notification_status: $request['notification_status']??null,
            user_ids: $request['user_ids']??null,
            deliveryMan_ids: $request['delivery_man_ids']??null,
            order: $request['order']??'DESC',
        );
    }
}
