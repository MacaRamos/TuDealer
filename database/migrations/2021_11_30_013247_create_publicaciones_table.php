<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->id('publicacion_id');
            $table->bigInteger('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('usuario_id')->on('usuarios');
            $table->string('titulo', 100);
            $table->string('nombre_semilla', 100);
            $table->bigInteger('tipo_semilla_id')->unsigned();
            $table->foreign('tipo_semilla_id')->references('tipo_semilla_id')->on('tipo_semillas');
            $table->text('descripcion');
            $table->double('porcentaje_THC', 3, 1);
            $table->double('porcentaje_CBD', 3, 1);
            $table->double('porcentaje_indica', 3, 1)->nullable();
            $table->double('porcentaje_sativa', 3, 1)->nullable();
            $table->double('porcentaje_ruderalis', 3, 1);
            $table->integer('tiempo_floracion');//semanas
            $table->integer('produccion_interior');
            $table->integer('produccion_exterior');
            $table->integer('altura')->nullable();//cm
            $table->integer('semillas_paquete');
            $table->integer('precio');
            $table->integer('stock');
            $table->datetime('fecha_creacion');
            $table->datetime('fecha_actualizacion')->nullable();
            $table->boolean('activa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publicaciones');
    }
}
