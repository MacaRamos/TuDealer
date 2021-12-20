<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regiones = [
            [1,'Arica y Parinacota','AP'],
            [2,'Tarapacá','TA'],
            [3,'Antofagasta','AN'],
            [4,'Atacama','AT'],
            [5,'Coquimbo','CO'],
            [6,'Valparaiso','VA'],
            [7,'Metropolitana de Santiago','RM'],
            [8,'Libertador General Bernardo O\'Higgins','OH'],
            [9,'Maule','MA'],
            [10,'Ñuble','NB'],
            [11,'Biobío','BI'],
            [12,'La Araucanía', 'AR'],
            [13,'Los Ríos','LR'],
            [14,'Los Lagos','LL'],
            [15,'Aysén del General Carlos Ibáñez del Campo','AI'],
            [16,'Magallanes y de la Antártica Chilena','MG']
        ];
        
        $regiones = array_map(function($region) {
            return [
                'region_id' => $region[0],
                'region' => $region[1],
                'abreviatura' => $region[2],
            ];
        }, $regiones);
        
        DB::table('regiones')->insert($regiones);
    }
}
