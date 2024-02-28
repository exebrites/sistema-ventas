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
        Schema::create('bocetos', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('disenios_id')->unique();
            $table->string('negocio');
            $table->string('objetivo');
            $table->string('publico');
            $table->string('contenido');
            $table->string('url_logo');
            $table->string('url_img');
            $table->foreignId('detallePedido_id')->constrained('detalle_pedidos');
            // $table->unsignedBigInteger('disenios_id')->unique();
            // $table->foreign('disenios_id')->references('id')->on('disenios')->onDelete('cascade');

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
        Schema::dropIfExists('bocetos');
    }
};
