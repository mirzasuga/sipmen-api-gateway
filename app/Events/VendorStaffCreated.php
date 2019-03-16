<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Vendor;
use App\VendorDetail;
use App\Models\Vendor\RoleVendor;

class VendorStaffCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $vendor;
    public $roles;
    public $vendorDetail;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Vendor $vendor, RoleVendor $roles, VendorDetail $vendorDetail)
    {
        $this->vendor = $vendor;
        $this->roles = $roles;
        $this->vendorDetail = $vendorDetail;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('vendor-staff-created');
    }
}
