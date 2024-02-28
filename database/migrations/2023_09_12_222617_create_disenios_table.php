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
        Schema::create('disenios', function (Blueprint $table) {

            $table->id();
            $table->foreignId('detallePedido_id')->constrained('detalle_pedidos')->uniqid;
            $table->string('url_imagen')->nullable();
            $table->string('url_disenio')->nullable();
            $table->boolean('disenio_estado');
            $table->boolean('revision');

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
        Schema::dropIfExists('disenios');
    }
};
