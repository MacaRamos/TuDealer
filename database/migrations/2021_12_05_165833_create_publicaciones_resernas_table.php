<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionesResernasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicaciones_resernas', function (Blueprint $table) {
            $table->id('reserna_id');
            $table->bigInteger('publicacion_id')->unsigned();
            $table->foreign('publicacion_id')->references('publicacion_id')->on('publicaciones');
            $table->bigInteger('compra_id')->unsigned();
            $table->foreign('compra_id')->references('compra_id')->on('compras');
            $table->integer('puntaje');
            $table->text('resena');//caracteres MAX
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publicaciones_resernas');
    }
}
