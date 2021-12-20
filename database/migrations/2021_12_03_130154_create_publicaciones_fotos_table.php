<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionesFotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicaciones_fotos', function (Blueprint $table) {
            $table->id('foto_id');
            $table->bigInteger('publicacion_id')->unsigned();
            $table->foreign('publicacion_id')->references('publicacion_id')->on('publicaciones');
            $table->string('foto', 1024);
            $table->integer('size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publicaciones_fotos');
    }
}
