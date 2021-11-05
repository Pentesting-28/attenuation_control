<?php

namespace Database\Seeders;

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
    	/*Esto le permite mantener un archivo donde puede encontrar fácilmente sus sembradoras.
        Tenga en cuenta que debe prestar atención al orden de sus llamadas con respecto a las restricciones de clave externa.
        No puede hacer referencia a una tabla que aún no existe.*/

        $this->call([
        	UserSeeder::class,
            SportSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
