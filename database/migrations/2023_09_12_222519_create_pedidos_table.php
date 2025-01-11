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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_entrega')->nullable();
            $table->float('costo_total');
            $table->foreign('clientes_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreignId('estado_id')->constrained('estados');
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
        Schema::dropIfExists('pedidos');
    }
};
