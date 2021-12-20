<?php

namespace App\Models\Publicacion;

use Illuminate\Database\Eloquent\Model;

class PublicacionFoto extends Model
{
    //publicaciones_fotos
    protected $table = 'publicaciones_fotos';
    protected $fillable = [
        'publicacion_id',
        'foto',
        'size'
    ];
    protected $primaryKey = 'foto_id';
    public $timestamps = false;
}
