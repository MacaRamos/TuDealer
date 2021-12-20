<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParametroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parametros = [
            ['Fotos', 1]
        ];
        
        $parametros = array_map(function($parametro) {
            return [
                'nombre' => $parametro[0],
                'indice' =>$parametro[1]
            ];
        }, $parametros);
        
        DB::table('parametros')->insert($parametros);
    }
}
