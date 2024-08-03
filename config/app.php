<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'Asia/Baghdad',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'ar',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store'  => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => ServiceProvider::defaultProviders()->merge([

        /*
         * Package Service Providers...
         */
        \App\Providers\CustomProvider::class,
        \App\Core\Auth\LoginServiceProvider::class,
        \App\Core\Shared\City\CityServiceProvider::class,
        \App\Core\Shared\Region\RegionServiceProvider::class,
        \App\Core\Shared\Address\AddressServiceProvider::class,
        \App\Core\Shared\User\UserServiceProvider::class,
        \App\Core\Pharmacy\Application\Providers\PharmacyServiceProvider::class,
        \App\Core\Distributor\Application\Providers\DistributorServiceProvider::class,
        \App\Core\Manufacturer\Application\Providers\ManufacturerServiceProvider::class,
        \App\Core\DistributorSubscription\Application\Providers\DistributorSubscriptionServiceProvider::class,
        \App\Core\Item\Application\Providers\ItemServiceProvider::class,
        \App\Core\Update\Application\Providers\UpdateServiceProvider::class,
        \App\Core\CartItem\Application\Providers\CartItemServiceProvider::class,
        \App\Core\Cart\Application\Providers\CartServiceProvider::class,
        \App\Core\Order\Application\Providers\OrderServiceProvider::class,
        \App\Core\Favourite\Application\Providers\FavouriteServiceProvider::class,
        \App\Core\Reminder\Application\Providers\ReminderServiceProvider::class,
        \App\Core\Feed\Application\Providers\FeedServiceProvider::class,
        \App\Core\ActivityLog\Application\Providers\ActivityLogServiceProvider::class,
        \App\Core\Shift\Application\Providers\ShiftServiceProvider::class,
        \App\Core\Offer\Application\Providers\OfferServiceProvider::class,
        \App\Core\PaymentType\Application\Providers\PaymentTypeServiceProvider::class,
        \App\Core\DeliveryGroup\Application\Providers\DeliveryGroupServiceProvider::class,
        \App\Core\DeliveryMan\Application\Providers\DeliveryManServiceProvider::class,
        \App\Core\Notification\Application\Providers\NotificationServiceProvider::class,
        \App\Core\Task\Application\Providers\TaskServiceProvider::class,
        \App\Core\About\Application\Providers\AboutServiceProvider::class,
        \App\Core\PrivacyPolicy\Application\Providers\PrivacyPolicyServiceProvider::class,
        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        Intervention\Image\ImageServiceProvider::class,
        Spatie\Permission\PermissionServiceProvider::class,
    ])->toArray(),

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        'Image' => Intervention\Image\Facades\Image::class
    ])->toArray(),

];
