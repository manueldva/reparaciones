<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'administrador',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('@dmin2018'),
            'userType' => 'ADMINISTRATOR',
        ]);


        DB::table('empresas')->insert([
            'nombre' => 'nombre empresa',
            'direccion' => 'S/D',
            'cuit' => '11-11111111-3',
            'ingresosbrutos' => '11-11-11111111-3',
            'inicioactividades' => '2000-01-01',
        ]);

    }
}
