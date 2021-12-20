<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSemillasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $semillas = [
            ['Tipo 1'],
            ['Tipo 2']
        ];
        
        $semillas = array_map(function($semilla) {
            return [
                'tipo_semilla_nombre' => $semilla[0]
            ];
        }, $semillas);
        
        DB::table('tipo_semillas')->insert($semillas);
    }
}
