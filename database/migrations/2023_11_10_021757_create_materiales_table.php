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
        Schema::create('materiales', function (Blueprint $table) {
            // id integer pk
            // nombre string
            // descripcion string
            // cod_interno string
            // stock string
            // unidad_medida string
            // fecha_adquisicion date
            // fecha_vencimiento date
            // notas string
            // precio_compra

            // categoria FK
            // proveedor FK
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('cod_interno')->nullable();
            $table->string('stock');
            // $table->string('unidad_medida')->nullable();
            $table->date('fecha_adquisicion');
            $table->date('fecha_vencimiento')->nullable();
            // $table->string('notas')->nullable();
            $table->double('precio_compra');
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
        Schema::dropIfExists('materiales');
    }
};
