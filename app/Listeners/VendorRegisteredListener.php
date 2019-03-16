<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\VendorRegistered;
use Illuminate\Support\Facades\Redis;

use Log;
use App\VendorDetail;
use App\Models\RoleVendor;
use App\Events\VendorDetailCreated;

class VendorRegisteredListener
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
    public function handle(VendorRegistered $event)
    {

        try {

            $vendorDetail = VendorDetail::create([
                'vendor_name' => null,
                'img_siup_url' => null,
                'img_tdp_url' => null,
                'img_akta_perusahaan_url' => null,
            ]);
            if (!$vendorDetail) {
                throw new \Exception('failed to create vendor detail for vendor user: '.json_encode($event->vendor));
            }
            event( new VendorDetailCreated($vendorDetail, $event->vendor) );

        } catch(\Exception $e) {

            Log::error($e->getMessage());
            Log::info(json_encode($event->vendor) );

        }
        
    }
}
