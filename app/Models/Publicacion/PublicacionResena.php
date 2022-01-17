<?php

namespace App\Models\Publicacion;

use App\Models\Compra\Compra;
use Illuminate\Database\Eloquent\Model;
use LaravelTreats\Model\Traits\HasCompositePrimaryKey;
use Awobaz\Compoships\Compoships;

class PublicacionResena extends Model
{
    use HasCompositePrimaryKey;
    use Compoships;
    //publicaciones_resernas
    protected $table = 'publicaciones_resernas';
    protected $fillable = [
        'compra_id',
        'publicacion_id',
        'puntaje',
        'resena'
    ];
    protected $primaryKey = ['reserna_id', 'compra_id', 'publicacion_id'];
    public $timestamps = false;

    public function compra()
    {
        return $this->hasOne(Compra::class, 'compra_id', 'compra_id');
    }
}
