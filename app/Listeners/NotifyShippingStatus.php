<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;

use App\Notifications\SendSmsShippingStatus;

class NotifyShippingStatus implements ShouldQueue
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Notification::route('mail', 'sugamirza@gmail.com')
        ->notify( new SendSmsShippingStatus($event->resi, $event->shippingStatus) );
        $event->resi->last_status = $event->shippingStatus->name;
        $event->resi->save();
    }
}
