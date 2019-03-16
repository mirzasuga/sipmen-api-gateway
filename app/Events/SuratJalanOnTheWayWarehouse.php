<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\ShippingStatus;
use App\SuratJalan;
use App\Resi;
use App\Vendor;

class SuratJalanOnTheWayWarehouse
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $suratJalan;
    public $resis;
    public $shippingStatus;
    public $courier;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(SuratJalan $suratJalan, $resis,
        ShippingStatus $shippingStatus,
        Vendor $courier)
    {
        $this->suratJalan = $suratJalan;
        $this->resis = $resis;
        $this->shippingStatus = $shippingStatus;
        $this->courier = $courier;
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
