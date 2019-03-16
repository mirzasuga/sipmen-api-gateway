<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Vendor\RoleVendor;
use Log;
class AttachRoleToVendorUser implements ShouldQueue
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
            if (!property_exists($event, 'roles')) {
                $roles = RoleVendor::firstOrCreate([
                    'name' => config('vendor_rules.default_role')
                ]);
            } else {
                $roles = $event->roles;
            }
            $event->vendor->roles()->attach($roles);
            Log::info('RoleVendor Attached '. $roles->name);

        } catch (\Exception $e) {
            Log::error('Failed To Attach Role Vor Vendor: ' . json_encode($event->vendor). 'And Role to Attach: '.$roles);
        }

    }
}
