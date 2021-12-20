<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    //comunas
    protected $table = "comunas";
    protected $fillable = [
        'id',
        'comuna',
        'provincia_id'
    ];
    protected $primaryKey = 'region_id';

    public function provincia()
    {
        return $this->hasOne(Provincia::class, 'provincia_id', 'provincia_id');
    }
}
