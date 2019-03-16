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
use App\Resi;
use App\ShippingStatus;

class ResiCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $updatedBy;
    public $resi;
    public $shippingStatus;
    public $additional;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        Vendor $updatedBy,
        Resi $resi,
        ShippingStatus $shippingStatus,
        $additional = []
    )
    {
        $this->updatedBy = $updatedBy;
        $this->resi = $resi;
        $this->shippingStatus = $shippingStatus;
        $this->additional = $additional;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
