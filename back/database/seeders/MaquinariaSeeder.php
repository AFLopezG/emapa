<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaquinariaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('maquinarias')->insert([
            ['nombre'=>'AIRE ACONDICIONADO'],
            ['nombre'=>'ALTAVOZ'],
            ['nombre'=>'BALANZA ANALITICA/PRECISION 3'],
            ['nombre'=>'BALANZA CAMIONERA 2'],
            ['nombre'=>'BALANZA QUINATELRA 3'],
            ['nombre'=>'BALANZA QUINTALERA'],
            ['nombre'=>'BANCOS DE MOLINO'],
            ['nombre'=>'BOMBAS DE AGUA'],
            ['nombre'=>'CAMARAS CCTV'],
            ['nombre'=>'CANJILLONES'],
            ['nombre'=>'CCM MOLINO'],
            ['nombre'=>'CINTA TRANSPORTADORA'],
            ['nombre'=>'CODIFICADORA'],
            ['nombre'=>'COLECTOR DE MUESTRA'],
            ['nombre'=>'COMPRESORAS'],
            ['nombre'=>'COSTURADORA DE PEDAL (AFRECHO)'],
            ['nombre'=>'DUCHAS'],
            ['nombre'=>'DUCTOS DE TRANSPORTE DE HARINA Y SALVADO GRUESO'],
            ['nombre'=>'ENVASADORA AUTOMATICA D1 - 2 KG'],
            ['nombre'=>'ENVASADORA AUTOMATICA DE 11,5 Y 50 KG'],
            ['nombre'=>'ESCALERAS, PLATAFORMA Y PUERTAS'],
            ['nombre'=>'EXTINGUIDORES'],
            ['nombre'=>'FILTROS'],
            ['nombre'=>'GENERADOR'],
            ['nombre'=>'GRATING Y CUBIERTAS'],
            ['nombre'=>'HUMEDECEDOR'],
            ['nombre'=>'MEDIDORES DE HUMEDAD DE GRANO 2'],
            ['nombre'=>'MIXER'],
            ['nombre'=>'MONTA CARGA'],
            ['nombre'=>'MOTORES DE MOLINO'],
            ['nombre'=>'MOTORES PRELIMPIEZA 1'],
            ['nombre'=>'MOTORES PRELIMPIEZA 2'],
            ['nombre'=>'PERFILES Y DEFORMACIONES'],
            ['nombre'=>'PLATAFORMA DE LA VOLCADORA'],
            ['nombre'=>'ROSCA BARREDORA'],
            ['nombre'=>'SARANDAS'],
            ['nombre'=>'SENSORES DE LLENADO'],
            ['nombre'=>'SISTEMA ELECTRICO'],
            ['nombre'=>'SISTEMA HIDRAULICO'],
            ['nombre'=>'SISTEMA MECANICO'],
            ['nombre'=>'SISTEMA NEUMATICO'],
            ['nombre'=>'TABLERO ELECTRICO'],
            ['nombre'=>'TELEFONOS'],
            ['nombre'=>'TERMOMETRIA'],
            ['nombre'=>'TOLVAS DE ALMACENAMIENTO DE HARINA'],
            ['nombre'=>'TOMAS ELECTRICAS'],
            ['nombre'=>'TORNILLOS SIN FIN'],
            ['nombre'=>'TRANSFORMADORES'],
            ['nombre'=>'VENTILADORES']
    ]);

    }
}
