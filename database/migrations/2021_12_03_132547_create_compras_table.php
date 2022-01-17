<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id('compra_id');
            $table->bigInteger('publicacion_id')->unsigned();
            $table->foreign('publicacion_id')->references('publicacion_id')->on('publicaciones');
            $table->bigInteger('usuario_id')->unsigned();
            $table->foreign('usuario_id')->references('usuario_id')->on('usuarios');
            $table->bigInteger('estado_compra_id')->unsigned();
            $table->foreign('estado_compra_id')->references('estado_compra_id')->on('estados_compra');
            $table->string('nombre_recibe');
            $table->string('RUT_recibe', 12);
            $table->string('celular_recibe');
            $table->string('email_recibe');
            $table->bigInteger('region_id')->unsigned();
            $table->foreign('region_id')->references('region_id')->on('regiones');
            $table->bigInteger('comuna_id')->unsigned();
            $table->foreign('comuna_id')->references('comuna_id')->on('comunas');
            $table->string('calle');
            $table->integer('numero_direccion');
            $table->integer('numero_departamento')->nullable();
            $table->string('medio_pago');
            $table->datetime('fecha_compra');
            $table->integer('unidades');
            $table->integer('precio_total');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}
