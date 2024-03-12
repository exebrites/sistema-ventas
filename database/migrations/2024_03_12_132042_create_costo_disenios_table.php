<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costo_disenios', function (Blueprint $table) {
            $table->id();
            $table->float('hora_disenio');
            $table->float('horas_disenio_completo');
            $table->float('horas_disenio_asistido');
            $table->float('porcentaje_costo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('costo_disenios');
    }
};
