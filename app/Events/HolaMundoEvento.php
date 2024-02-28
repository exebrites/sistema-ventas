<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HolaMundoEvento
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $stock, $minimo_stock;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($stock, $minimo_stock = 10)
    {
        $this->stock = $stock;
        $this->minimo_stock = $minimo_stock;
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
