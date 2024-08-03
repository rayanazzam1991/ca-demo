<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Connectors\RabbitMQConnector;

class CustomProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
//        $queue = $this->app['queue'];
//        $queue->addConnector('rabbitmq', function () {
//            return new RabbitMQConnector($this->app['events']);
//        });
    }
}
