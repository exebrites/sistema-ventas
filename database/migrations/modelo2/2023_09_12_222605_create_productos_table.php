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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->double('precio');
            $table->text('descripcion')->nullable();
            $table->string('imagen')->nullable()->unique();
            $table->string('alias')->nullable()->unique();
            $table->integer('visitas')->default(1);
            $table->integer('stock')->default(1);
            $table->boolean('activo')->default(true);
            $table->string('sku')->nullable()->unique();
            $table->foreignId('category_id')->constrained('categorias');
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
        Schema::dropIfExists('productos');
    }
};
