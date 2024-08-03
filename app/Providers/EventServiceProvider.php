<?php

namespace App\Providers;

use App\Events\SendNotificationEvent;
use App\Events\SyncDeliveryImageEvent;
use App\Events\SyncManufacturerImageEvent;
use App\Jobs\NotificationLandlordInformerJob;
use App\Listeners\SendNotificationListener;
use App\Listeners\SyncDeliveryManImageListener;
use App\Listeners\SyncManufacturerImageListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        SyncDeliveryImageEvent::class=>[
            SyncDeliveryManImageListener::class
        ],
        SyncManufacturerImageEvent::class=>[
            SyncManufacturerImageListener::class
        ],
        SendNotificationEvent::class=>[
            SendNotificationListener::class
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
