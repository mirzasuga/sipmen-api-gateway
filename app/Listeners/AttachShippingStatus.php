<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Resi;
use App\ShippingStatus;

use App\Events\ShippingStatusUpdated;

class AttachShippingStatus implements ShouldQueue
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
        $resi = Resi::findOrFail($event->resiId);
        $shippingStatus = ShippingStatus::where('code', $event->shippingStatusCode)->firstOrFail();
        $resi->shippingStatus()->attach($shippingStatus, [
            'note' => 'Created By System - '.date('Y-m-d H:i:s'),
            'updated_by' => $event->staff->id,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        event(new ShippingStatusUpdated($resi,$shippingStatus));

    }
}
