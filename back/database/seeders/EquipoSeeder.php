<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('equipos')->insert([
            ['codigo'=>'1','nombre'=>'CALADOR HIDRAULICO','ubicacion'=>'PLANTA','adquisicion'=>'2000-01-01','operador'=>'GUIDO COLQUE TERAN'],
            ['codigo'=>'2','nombre'=>'VOLCADOR HIDRAULICO','ubicacion'=>'PLANTA','adquisicion'=>'2000-01-01','operador'=>'GUIDO COLQUE TERAN'],
            ['codigo'=>'3','nombre'=>'SILOS ALMACEN','ubicacion'=>'PLANTA','adquisicion'=>'2000-01-01','operador'=>'GUIDO COLQUE TERAN'],
            ['codigo'=>'4','nombre'=>'ACOPIO - PRELIMPIEZA','ubicacion'=>'PLANTA','adquisicion'=>'2000-01-01','operador'=>'GUIDO COLQUE TERAN'],
            ['codigo'=>'5','nombre'=>'AREA DE TRANSFORMACION PRE-LIMPIEZA','ubicacion'=>'PLANTA','adquisicion'=>'2000-01-01','operador'=>'GUIDO COLQUE TERAN'],
            ['codigo'=>'6','nombre'=>'PRE-LIMPIEZA II','ubicacion'=>'PLANTA','adquisicion'=>'2000-01-01','operador'=>'GUIDO COLQUE TERAN'],
            ['codigo'=>'7','nombre'=>'MOLINO','ubicacion'=>'PLANTA','adquisicion'=>'2000-01-01','operador'=>'GUIDO COLQUE TERAN'],
            ['codigo'=>'8','nombre'=>'AREA DE ENVASADO','ubicacion'=>'ENVASADO','adquisicion'=>'2000-01-01','operador'=>'GUIDO COLQUE TERAN'],
            ['codigo'=>'9','nombre'=>'MAESTRANZA Y ALMACEN','ubicacion'=>'ALMACEN','adquisicion'=>'2000-01-01','operador'=>'GUIDO COLQUE TERAN'],
            ['codigo'=>'10','nombre'=>'AREA DE ADMINISTRACION','ubicacion'=>'ADMINISTRACION','adquisicion'=>'2000-01-01','operador'=>'GUIDO COLQUE TERAN'],
            ['codigo'=>'11','nombre'=>'EQUIPOS DE MEDICION','ubicacion'=>'ADMINISTRACION','adquisicion'=>'2000-01-01','operador'=>'GUIDO COLQUE TERAN'],


        ]);
    }
}
