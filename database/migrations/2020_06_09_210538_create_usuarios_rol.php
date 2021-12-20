<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosRol extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_rol', function (Blueprint $table) {
            $table->bigInteger('rol_id')->unsigned();
            $table->foreign('rol_id')->references('rol_id')->on('roles');
            $table->bigInteger('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('usuario_id')->on('usuarios');
            $table->boolean('rol_estado')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_rol');
    }
}
