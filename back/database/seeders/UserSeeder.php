<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('rols')->insert([
            ['id'=>1,'nombre'=>'ADMINISTRADOR','descripcion'=>''],
            ['id'=>2,'nombre'=>'SUPERVISOR','descripcion'=>''],
            ['id'=>3,'nombre'=>'TECNICO','descripcion'=>''],
            ['id'=>4,'nombre'=>'ALMACEN','descripcion'=>''],
        ]);

        DB::table('users')->insert([
            ['nombre'=>'admin','apellido'=>'admin','cedula'=>'00001','name'=>'Admin','email'=>'admin@test.com',"rol_id"=>1,'password'=>Hash::make('123456')],
        ]);

    }
}
