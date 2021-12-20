<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carrito_compras', function (Blueprint $table) {
            $table->id('carrito_id');
            $table->bigInteger('compra_id')->unsigned();
            $table->foreign('compra_id')->references('compra_id')->on('compras');
            $table->bigInteger('publicacion_id')->unsigned();
            $table->foreign('publicacion_id')->references('publicacion_id')->on('publicaciones');
            $table->integer('cantidad');
            $table->integer('precio');
            $table->integer('monto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carrito_compras');
    }
}
