<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\OrderCompletedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendNotificationMails
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $orders= $event->orders;
        foreach($orders as $order){
        $user= User::where('store_id', $order->store_id)->first();
        $user->notify(new OrderCompletedNotification($order));
        }
    }
}
