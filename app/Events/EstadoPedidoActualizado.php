<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EstadoPedidoActualizado
{
    use Dispatchable, SerializesModels;

    public $pedido;
    public $nuevoEstado;

    public function __construct($pedido, $nuevoEstado)
    {
        $this->pedido = $pedido;
        $this->nuevoEstado = $nuevoEstado;
    }
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
