<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\SuratJalan;
use App\Resi;
use App\ShippingStatus;
use App\Vendor;

class ResiAttachedToSuratJalan implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $suratJalan;
    public $resi;
    public $shippingStatus;
    public $resiId;
    public $shippingStatusCode;
    public $staff;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        SuratJalan $suratJalan, Resi $resi,
        ShippingStatus $shippingStatus, Vendor $staff
    ) {
        $this->suratJalan = $suratJalan;
        $this->resi = $resi;
        $this->resiId = $resi->id;
        $this->shippingStatus = $shippingStatus;
        $this->shippingStatusCode = $shippingStatus->code;
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
