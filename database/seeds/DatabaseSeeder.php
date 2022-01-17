<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserRolSeeder::class);
        $this->call(ParametroSeeder::class);
        $this->call(TipoSemillasSeeder::class);
        $this->call(RegionSeeder::class);
        $this->call(ProvinciaSeeder::class);
        $this->call(ComunaSeeder::class);
        $this->call(EstadoCompraSeeder::class);
    }
}
