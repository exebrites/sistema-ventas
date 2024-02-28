<?php

namespace App\Listeners;

use App\Mail\EstadoMailable;
use App\Events\HolaMundoEvento;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HolaMundoListener
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
     * @param  \App\Events\HolaMundoEvento  $event
     * @return void
     */
    public function handle(HolaMundoEvento $event)
    {
        // dd($event->stock);
        $stock = $event->stock;
        $minimo_stock = $event->minimo_stock;
        if ($stock <= $minimo_stock) {
            # code...
            Mail::to('exe@gmail.com')->send(new EstadoMailable);
        }
    }
}
