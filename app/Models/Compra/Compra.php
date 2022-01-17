<?php

namespace App\Models\Compra;

use App\Models\Publicacion\Publicacion;
use App\Models\Publicacion\PublicacionResena;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    //compras
    protected $table = 'compras';
    protected $fillable = [
        'publicacion_id',
        'usuario_id',
        'estado_compra_id',
        'nombre_recibe',
        'RUT_recibe',
        'celular_recibe',
        'email_recibe',
        'region_id',
        'comuna_id',
        'calle',
        'numero_direccion',
        'numero_departamento',
        'medio_pago',
        'fecha_compra',
        'unidades',
        'precio_total'
    ];
    protected $primaryKey = 'compra_id';
    public $timestamps = false;

    public function estado()
    {
        return $this->hasOne(EstadoCompra::class, 'estado_compra_id', 'estado_compra_id');
    }

    public function publicacion()
    {
        return $this->hasOne(Publicacion::class, 'publicacion_id', 'publicacion_id');
    }

    public function comprador()
    {
        return $this->hasOne(Usuario::class, 'usuario_id', 'usuario_id');
    }
}
