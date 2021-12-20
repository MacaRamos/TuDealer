<?php

namespace App\Models;

use App\Models\Provincia;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //regiones
    protected $table = "regiones";
    protected $fillable = [
        'region',
        'abreviatura'
    ];
    protected $primaryKey = 'region_id';

    public function provincias(){
        return $this->hasMany(Provincia::class);
    }
}
