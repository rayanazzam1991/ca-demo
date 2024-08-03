<?php

namespace App\Console\Commands;

use App\Core\Notification\Infrastructure\Eloquent\NotificationModel;
use App\Enums\NotificationStatusEnum;
use App\Events\SendNotificationEvent;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-notification-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $notifications = NotificationModel::query()
            ->where('status', NotificationStatusEnum::SCHEDULE->value)
            ->where('schedule_time', '<=', Carbon::now())
            ->get();
        foreach ($notifications as $notification)
            SendNotificationEvent::dispatch($notification->id);
    }
}
