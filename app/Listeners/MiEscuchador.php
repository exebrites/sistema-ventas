<?php

namespace App\Listeners;

use App\Events\MiEvento;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MiEscuchador
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
     * @param  \App\Events\MiEvento  $event
     * @return void
     */
    public function handle($event)
    {
        // Lógica del controlador que deseas ejecutar
        // ...

        // Retornar "Hola Mundo"
        return "Hola Mundo";
    }
}
