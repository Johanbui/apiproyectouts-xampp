<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $arr = array(
            array('nombre' => 'Tipos de Documento', 'codigo' => 'TIPDOC', 'estado' => true),
            array('nombre' => 'Modalidad Trabajo de Grado', 'codigo' => 'MODGRA', 'estado' => true),
            array('nombre' => 'Linea Investigación', 'codigo' => 'LININV', 'estado' => true),
            array('nombre' => 'Coordinaciones', 'codigo' => 'COORD', 'estado' => true),
            array('nombre' => 'Tipos Usuario Ideas', 'codigo' => 'TIPIDU', 'estado' => true),
            array('nombre' => 'Formatos Propuesta', 'codigo' => 'FRTOPRO', 'estado' => true),
            array('nombre' => 'Formatos Informe Final', 'codigo' => 'FRTOFIN', 'estado' => true),
            array('nombre' => 'Aprobacion Idea', 'codigo' => 'APRIDEA', 'estado' => true),
            array('nombre' => 'Estados Idea', 'codigo' => 'ESTIDEA', 'estado' => true),
        );

        DB::table('listas_grupos')->insert($arr);

        $arr = array(
            array(
                'id_lista_grupo' => '1', 'nombre' => 'Cédula Ciudadanía',
                'codigo' => 'CC', 'valor' => '1', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '1', 'nombre' => 'Cédula Extranjería',
                'codigo' => 'CE', 'valor' => '2', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '1', 'nombre' => 'Nit',
                'codigo' => 'NIT', 'valor' => '3', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '2', 'nombre' => 'Desarrollo de Software',
                'codigo' => 'DESSOF', 'valor' => '1', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '2', 'nombre' => 'Proyecto de Investigación',
                'codigo' => 'PROINV', 'valor' => '2', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '3', 'nombre' => 'Nuevas Tecnologia',
                'codigo' => 'NUETEC', 'valor' => '1', 'estado' => true,
                'idPadre' => '4'
            ),
            array(
                'id_lista_grupo' => '3', 'nombre' => 'Desarrollo de Software Orientado a la WEB',
                'codigo' => 'DESOWEB', 'valor' => '2', 'estado' => true,
                'idPadre' => '4'
            ),
            array(
                'id_lista_grupo' => '4', 'nombre' => 'Tecnologia en Desarrollo de Sistemas Informaticos',
                'codigo' => 'TDSI', 'valor' => '1', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '4', 'nombre' => 'Ingenieria de Sistemas',
                'codigo' => 'INGS', 'valor' => '2', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '5', 'nombre' => 'Estudiante',
                'codigo' => 'EST', 'valor' => '1', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '5', 'nombre' => 'Director',
                'codigo' => 'DIR', 'valor' => '2', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '5', 'nombre' => 'CO/Director',
                'codigo' => 'CODIR', 'valor' => '3', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '6', 'nombre' => 'F-DC-124',
                'codigo' => 'FDC124', 'valor' => '1', 'estado' => true,
                'idPadre' => 4
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-DC-125 - Informe Final',
                'codigo' => 'FDC125', 'valor' => '1', 'estado' => true,
                'idPadre' => 4
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-DC-129 - Rejilla de Evaluación',
                'codigo' => 'FDC129', 'valor' => '2', 'estado' => true,
                'idPadre' => 4
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-GC-01 - Licencia de Autorización Interna',
                'codigo' => 'FGC01', 'valor' => '3', 'estado' => true,
                'idPadre' => 4
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-GC-02 - Ficha de Metadatos',
                'codigo' => 'FGC02', 'valor' => '4', 'estado' => true,
                'idPadre' => 4
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'Exposición Trabajo de Grado',
                'codigo' => 'EXP01', 'valor' => '5', 'estado' => true,
                'idPadre' => 4
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'Otros Archivos de Sustentación',
                'codigo' => 'OTROS', 'valor' => '6', 'estado' => true,
                'idPadre' => 4
            ),
            array(
                'id_lista_grupo' => '8', 'nombre' => 'Pago Modalidad',
                'codigo' => 'PAGMOD', 'valor' => '1', 'estado' => true,
                'idPadre' => null
            ),

            array(
                'id_lista_grupo' => '9', 'nombre' => 'Aprobacion de Idea',
                'codigo' => 'APRIDEA', 'valor' => '1', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '9', 'nombre' => 'Propuesta de Idea',
                'codigo' => 'PROIDEA', 'valor' => '2', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '9', 'nombre' => 'Evaluacion de Propuesta de Idea',
                'codigo' => 'EVPROIDEA', 'valor' => '3', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '9', 'nombre' => 'Informe Final',
                'codigo' => 'INFFIN', 'valor' => '4', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '9', 'nombre' => 'Evaluacion Informe Final',
                'codigo' => 'EVINFFIN', 'valor' => '5', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '9', 'nombre' => 'Resultado Proyecto',
                'codigo' => 'SELIDEA', 'valor' => '6', 'estado' => true,
                'idPadre' => null
            ),
        );
        DB::table('listas')->insert($arr);
    }
}
