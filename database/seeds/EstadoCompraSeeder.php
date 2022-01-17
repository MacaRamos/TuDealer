<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            ['En proceso'],
            ['En camino'],
            ['Entregado'],
            ['Evaluado']
        ];
        
        $estados = array_map(function($estado) {
            return [
                'estado_compra_nombre' => $estado[0]
            ];
        }, $estados);
        
        DB::table('estados_compra')->insert($estados);
    }
}
