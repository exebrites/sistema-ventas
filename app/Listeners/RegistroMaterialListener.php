<?php

namespace App\Listeners;

use App\Events\RegistroMaterialEvent;
use App\Models\RegistroMaterial;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegistroMaterialListener
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
     * @param  \App\Events\RegistroMaterialEvent  $event
     * @return void
     */
    public function handle(RegistroMaterialEvent $event)
    {
        // dd($event->material.'escuchador');
        $material = $event->material;
        RegistroMaterial::create([
            'material_id' => $material->id,
            'cantidad' => $material->stock
        ]);
    }
}
