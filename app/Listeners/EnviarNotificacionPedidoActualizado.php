<?php

namespace App\Listeners;

use App\Events\EstadoPedidoActualizado;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EnviarNotificacionPedidoActualizado
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
     * @param  \App\Events\EstadoPedidoActualizado  $event
     * @return void
     */
    public function handle(EstadoPedidoActualizado $event)
    {
        //
    }
}
