<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provincias = [
            [1,'Arica',1],
            [2,'Parinacota',1],
            [3,'Iquique',2],
            [4,'El Tamarugal',2],
            [5,'Tocopilla',3],
            [6,'El Loa',3],
            [7,'Antofagasta',3],
            [8,'Chañaral',4],
            [9,'Copiapó',4],
            [10,'Huasco',4],
            [11,'Elqui',5],
            [12,'Limarí',5],
            [13,'Choapa',5],
             [14,'Petorca',6],
            [15,'Los Andes',6],
             [16,'San Felipe de Aconcagua',6],
             [17,'Quillota',6],
            [18,'Valparaiso',6],
            [19,'San Antonio',6],
            [20,'Isla de Pascua',6],
            [21,'Marga Marga',6],
            [22,'Chacabuco',7],
            [23,'Santiago',7],
            [24,'Cordillera',7],
            [25,'Maipo',7],
            [26,'Melipilla',7],
            [27,'Talagante',7],
            [28,'Cachapoal',8],
            [29,'Colchagua',8],
            [30,'Cardenal Caro',8],
            [31,'Curicó',9],
            [32,'Talca',9],
             [33,'Linares',9],
            [34,'Cauquenes',9],
            [35,'Diguillín',10],
            [36,'Itata',10],
            [37,'Punilla',10],
            [38,'Bio Bío',11],
            [39,'Concepción',11],
            [40,'Arauco',11],
            [41,'Malleco',12],
            [42,'Cautín',12],
            [43,'Valdivia',13],
            [44,'Ranco',13],
            [45,'Osorno',14],
            [46,'Llanquihue',14],
            [47,'Chiloé',14],
            [48,'Palena',14],
            [49,'Coyhaique',15],
            [50,'Aysén',15],
            [51,'General Carrera',15],
            [52,'Capitán Prat',15],
            [53,'Última Esperanza',16],
            [54,'Magallanes',16],
            [55,'Tierra del Fuego',16],
            [56,'Antártica Chilena',16]
        ];
        
        $provincias = array_map(function($provincia) {
            return [
                'provincia_id' => $provincia[0],
                'provincia' => $provincia[1],
                'region_id' => $provincia[2]
            ];
        }, $provincias);
        
        DB::table('provincias')->insert($provincias);
    }
}
