<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {     

        $users = [
            ['maca', '18.814.028-9', 'Macarena', 'Ramos', '', new DateTime('01-04-1994'), '+569 71358272', 'macarenaarp@gmail.com', '123pormi'],
        ];
        
        $users = array_map(function($user) {
            return [
                'nombre_usuario' => $user[0],
                'RUT' => $user[1],
                'nombre' => $user[2],
                'apellido_materno' => $user[3],
                'apellido_paterno' => $user[4],
                'fecha_nacimiento' => $user[5],
                'celular' => $user[6],
                'email' => $user[7],
                'password' => Hash::make($user[8]),
                'fecha_creacion' => date('Y-m-d H:i:s'),
                'fecha_actualizacion' => date('Y-m-d H:i:s')
            ];
        }, $users);
        
        DB::table('usuarios')->insert($users);
    }
}

