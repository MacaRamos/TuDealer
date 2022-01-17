<?php

namespace App\Models\Compra;

use Illuminate\Database\Eloquent\Model;

class EstadoCompra extends Model
{
    const EN_PROCESO = 1;
    const EN_CAMINO = 2;
    const ENTREGADA = 3;
    const EVALUADA = 4;
    //estados_compra
    protected $table = 'estados_compra';
    protected $fillable = [
        'estado_compra_nombre'
     ];
    protected $primaryKey = 'estado_compra_id';
    public $timestamps = false;
}
