<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovimientoInventarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientoinventario', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('producto_id');
            $table->unsignedInteger('inventario_id')->nullable();
            $table->integer('cantidad_anterior')->nullable();
            $table->integer('cantidad_ingresada');
            $table->integer('cantidad_nueva')->nullable();
            $table->timestamps();
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('inventario_id')->references('id')->on('inventario');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientoinventario');
    }
}
