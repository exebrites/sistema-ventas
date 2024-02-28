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
        //cambiar el nombre de los atributos
        Schema::create('productos', function (Blueprint $table) {
            //crear una FK y la asocia con su tabla 
            // $table->foreignId('pedido_id')->constrained('pedidos');


            // id integer [PK]
            // alias string
            // nombre char
            // precio float
            // especificacion char

            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->double('price');
            $table->text('description')->nullable();
            $table->string('image_path')->nullable()->unique();
            $table->string('alias')->nullable()->unique();
            $table->integer('visitas')->default(1);
            
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
