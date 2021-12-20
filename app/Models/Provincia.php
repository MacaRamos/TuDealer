<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    //provincias
    protected $table = "provincias";
    protected $fillable = [
        'provincia',
        'region_id'
    ];
    protected $primaryKey = 'provincia_id';

    public function comunas()
    {
        return $this->hasMany(Comuna::class);
    }

    public function region()
    {
        return $this->hasOne(Region::class, 'region_id', 'region_id');
    }
}
