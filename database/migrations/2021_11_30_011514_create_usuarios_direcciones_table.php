<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosDireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_direcciones', function (Blueprint $table) {
            $table->id('direccion_id');
            $table->bigInteger('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('usuario_id')->on('usuarios');
            $table->string('direccion', 80);
            $table->bigInteger('region_id')->unsigned();
            $table->foreign('region_id')->references('region_id')->on('regiones');
            $table->bigInteger('comuna_id')->unsigned();
            $table->foreign('comuna_id')->references('comuna_id')->on('comunas');
            $table->boolean('ventas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_direcciones');
    }
}
