<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionesComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicaciones_comentarios', function (Blueprint $table) {
            $table->id('comentario_id');
            $table->bigInteger('publicacion_id')->unsigned();
            $table->foreign('publicacion_id')->references('publicacion_id')->on('publicaciones');
            $table->bigInteger('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('usuario_id')->on('usuarios');
            $table->text('comentario');//caracteres MAX
            $table->dateTime('fecha_comentario');
            $table->bigInteger('respuesta_comentario_id')->unsigned();
            $table->foreign('respuesta_comentario_id')->nullable()->references('comentario_id')->on('publicaciones_comentarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publicaciones_comentarios');
    }
}
