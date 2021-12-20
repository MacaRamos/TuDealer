<?php

namespace App\Models\Publicacion;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    //publicaciones
    protected $table = 'publicaciones';
    protected $fillable = [
        'usuario_id',
        'titulo',
        'nombre_semilla',
        'tipo_semilla_id',
        'descripcion',
        'porcentaje_THC',
        'porcentaje_CBD',
        'porcentaje_indica',
        'porcentaje_sativa',
        'porcentaje_ruderalis',
        'tiempo_floracion',
        'produccion_interior',
        'produccion_exterior',
        'altura',
        'semillas_paquete',
        'precio',
        'stock',
        'fecha_creacion',
        'fecha_actualizacion',
        'activa'
    ];
    protected $primaryKey = 'publicacion_id';
    public $timestamps = false;


    public function fotos(){
        return $this->hasMany(PublicacionFoto::class, 'publicacion_id', 'publicacion_id');
    }

    public function tipo(){
        return $this->hasOne(TipoSemilla::class, 'tipo_semilla_id', 'tipo_semilla_id');
    }

}
