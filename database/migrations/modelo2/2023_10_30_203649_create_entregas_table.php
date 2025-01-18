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
        Schema::create('entregas', function (Blueprint $table) {


            $table->id();
            $table->unsignedBigInteger('pedido_id')->unique();
            $table->string('direccion');
            $table->string('telefono');
            $table->string('recepcion');
            $table->string('nota');
            $table->boolean('local');

            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');


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
        Schema::dropIfExists('entregas');
    }
};
