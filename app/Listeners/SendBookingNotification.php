<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Models\User;
use App\Notifications\BookingNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendBookingNotification
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
     * @param  \App\Events\BookingCreated  $event
     * @return void
     */
    public function handle(BookingCreated $event)
    {
        $adminUser = User::whereHas('nama_role', function ($query) {
            $query->where('name', 'admin');
        })->get();


        foreach ($adminUser as $user) {
            $user->notify(new BookingNotification($event->booking));
        }
    }
}