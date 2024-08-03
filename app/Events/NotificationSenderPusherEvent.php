<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class NotificationSenderPusherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $notification;
    public int $userId;
    public ?string $lang;


    /**
     * Create a new event instance.
     */
    public function __construct(array $notification, int $userId, ?string $lang)
    {
        $this->notification = $notification;
        $this->userId = $userId;
        $this->lang = $lang;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('user-' . $this->userId . '-' . 'pharmacy-notification-channel'),
        ];
    }

    public function broadcastWith()
    {
        return [
            "notification" => [
                'id' => $this->notification['id'],
                'body' => $this->lang == 'en' ? $this->notification['body_en'] : $this->notification['body_ar'],
                'title' => $this->lang == 'en' ? $this->notification['title_en'] : $this->notification['title_ar'],
                'created_at' => $this->notification['created_at']

            ]
        ];
    }
    public function broadcastAs()
    {
        return 'pharmacy-notification-event';
    }
}
