<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Vendor\RoleVendor;
use Log;

class AttachVendorDetailToVendorUser implements ShouldQueue
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
        try {

            $event->vendor->vendor_detail_id = $event->vendorDetail->id;
            $event->vendor->save();
            Log::info('VendorDetailId Attached '. $event->vendorDetail->vendor_name);

        } catch(\Exception $e) {
            Log::info('Failed to attach role vendor for'.json_encode($event->vendor).'| with vendor detail detail:'.json_encode($event->vendorDetail));

        }
    }
}
