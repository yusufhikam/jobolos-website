<?php

namespace App\Providers;

use App\Events\BookingCreated;
use App\Events\PaymentCompleted;
use App\Listeners\SendBookingNotification;
use App\Listeners\SendPaymentNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        BookingCreated::class => [
            SendBookingNotification::class,
        ],

        PaymentCompleted::class => [
            SendPaymentNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}