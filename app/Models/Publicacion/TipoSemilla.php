<?php

namespace App\Models\Publicacion;

use Illuminate\Database\Eloquent\Model;

class TipoSemilla extends Model
{
    //tipo_semillas
    protected $table = 'tipo_semillas';
    protected $fillable = [
        'tipo_semilla_nombre'
    ];
    protected $primaryKey = 'tipo_semilla_id';
    public $timestamps = false;

    public function publicaciones(){
        return $this->hasMany(Publicacion::class, 'tipo_semilla_id', 'tipo_semilla_id');
    }
}
