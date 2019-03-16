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

class QueueShippingStatus
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $resiId;
    public $shippingStatusCode;
    public $staff;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($resiId, String $shippingStatusCode, Vendor $staff)
    {
        $this->resiId = $resiId;
        $this->shippingStatusCode = $shippingStatusCode;
        $this->staff = $staff;
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
