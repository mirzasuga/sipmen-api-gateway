<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\ShippingStatusUpdated;
use App\Events\QueueShippingStatus;
class BulkUpdateShippingStatus implements ShouldQueue
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
        $shippingStatus = $event->shippingStatus;
        $resis = $event->resis;
        foreach ($resis as $item) {
            event(new ShippingStatusUpdated($item, $shippingStatus));
            event(new QueueShippingStatus(
                $item->id,
                $shippingStatus->code,
                $event->courier
                )
            );
        }
    }
}
