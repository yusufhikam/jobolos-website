<?php

namespace App\Listeners;

use App\Events\PaymentCompleted;
use App\Models\User;
use App\Notifications\PaymentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendPaymentNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PaymentCompleted  $event
     * @return void
     */
    public function handle(PaymentCompleted $event)
    {
        $adminUser = User::whereHas('nama_role', function ($query) {
            $query->where('name', 'admin');
        })->get();


        foreach ($adminUser as $user) {
            $user->notify(new PaymentNotification($event->payment));
        }
    }
}