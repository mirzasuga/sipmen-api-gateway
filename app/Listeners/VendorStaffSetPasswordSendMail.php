<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;
use Illuminate\Support\Facades\Redis;
use App\Mail\VendorStaffSendMail;

class VendorStaffSetPasswordSendMail implements ShouldQueue
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
        $vendor = $event->vendor;
        $token = str_random(16);
        $expired = env('VENDOR_STAFF_VERIFICATION_EXPIRED') + 0;
        Redis::set('vendors:'.$vendor->id.':token',$token, 'EX', $expired );
        $LINK_CONFIRMATION = env('LINK_STAFF_CONFIRMATION');
        $link = "$LINK_CONFIRMATION/$vendor->id/$token";

        Mail::to($vendor->email)->send(new VendorStaffSendMail($link));
    }
}
