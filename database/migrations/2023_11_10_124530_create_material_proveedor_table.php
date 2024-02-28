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
        Schema::create('material_proveedor', function (Blueprint $table) {

            // id integer
            // proveedor_id integer
            // material_id integer
            // precio_actual float
            // precio_actualizado float
            $table->id();
            $table->foreignId('proveedor_id')->constrained('proveedores');
            $table->foreignId('material_id')->constrained('materiales');
            $table->float('precio_actual');
            $table->float('precio_actualizado');
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
        Schema::dropIfExists('material_proveedor');
    }
};
