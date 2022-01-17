<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersRol = [
            [1,1, true]//Maca
        ];
        
        $usersRol = array_map(function($userRol) {
            return [
                'rol_id' => $userRol[0],
                'usuario_id' => $userRol[1],                
                'rol_estado' => $userRol[2]
            ];
        }, $usersRol);
        
        DB::table('usuarios_rol')->insert($usersRol);
    }
}
