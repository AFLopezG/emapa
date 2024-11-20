<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('permisos')->insert([
            ['nombre'=>'Gestion Usuarios','descripcion'=>'Actualizar cuenta de Usuarios'],
            ['nombre'=>'Gestion Maquinaria','descripcion'=>'Actualizar cuenta de Usuarios'],
            ['nombre'=>'Gestion Equipos','descripcion'=>'Actualizar cuenta de Usuarios'],
            ['nombre'=>'Gestion Actividades','descripcion'=>'Actualizar cuenta de Usuarios'],
            ['nombre'=>'Agenda Mtto','descripcion'=>'Actualizar cuenta de Usuarios'],
            ['nombre'=>'Cumplimiento Agenda','descripcion'=>'Actualizar cuenta de Usuarios'],
            ['nombre'=>'Gestion Inventario','descripcion'=>'Actualizar cuenta de Usuarios'],
            ['nombre'=>'Registro de Compra','descripcion'=>'Actualizar cuenta de Usuarios'],
            ['nombre'=>'Registro de Orden Trabajo','descripcion'=>'Actualizar cuenta de Usuarios'],
            ['nombre'=>'Registro Salida Material','descripcion'=>'Actualizar cuenta de Usuarios'],
        ]);

    }
}
