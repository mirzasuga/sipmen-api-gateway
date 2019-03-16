<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CourierLocationUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $coords;
    public $suratJalanId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($suratJalanId, $coords)
    {
        $this->coords = $coords;
        $this->suratJalanId = $suratJalanId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('courier-location.'.$this->suratJalanId);
    }

    public function broadcastWith() {
        return [
            'coords' => $this->coords
        ];
    }
}
