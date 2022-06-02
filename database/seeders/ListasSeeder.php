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
                'id_lista_grupo' => '2', 'nombre' => 'Desarrollo de Tecnologico',
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
                'id_lista_grupo' => '9', 'nombre' => 'Resultado Trabajo de Grado en Prorroga',
                'codigo' => 'PROEIDEA', 'valor' => '6', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '9', 'nombre' => 'Resultado Trabajo de Grado en Aprobado',
                'codigo' => 'APREIDEA', 'valor' => '7', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '9', 'nombre' => 'Resultado Trabajo de Grado en NO Aprobado',
                'codigo' => 'CANEIDEA', 'valor' => '8', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '9', 'nombre' => 'Resultado Trabajo de Grado en En Ejecucion',
                'codigo' => 'EJECIDEA', 'valor' => '10', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '9', 'nombre' => 'Resultado Trabajo de Grado en Expirado',
                'codigo' => 'EXPIDEA', 'valor' => '11', 'estado' => true,
                'idPadre' => null
            ),


            array(
                'id_lista_grupo' => '7', 'nombre' => 'Prorroga',
                'codigo' => 'PRORROGA', 'valor' => '99', 'estado' => true,
                'idPadre' => 4
            ),
            array(
                'id_lista_grupo' => '2', 'nombre' => 'Monografia',
                'codigo' => 'MODMONO', 'valor' => '3', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '2', 'nombre' => 'Emprendimiento',
                'codigo' => 'MODEMPR', 'valor' => '4', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '2', 'nombre' => 'Seminario',
                'codigo' => 'MODSEMI', 'valor' => '5', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '2', 'nombre' => 'Practica',
                'codigo' => 'MODPRAC', 'valor' => '6', 'estado' => true,
                'idPadre' => null
            ),
            array(
                'id_lista_grupo' => '3', 'nombre' => 'Monografia',
                'codigo' => 'LINMONO', 'valor' => '3', 'estado' => true,
                'idPadre' => 32
            ),
            array(
                'id_lista_grupo' => '3', 'nombre' => 'Emprendimiento',
                'codigo' => 'LINEMPR', 'valor' => '4', 'estado' => true,
                'idPadre' => 33
            ),
            array(
                'id_lista_grupo' => '3', 'nombre' => 'Seminario',
                'codigo' => 'LINSEM', 'valor' => '5', 'estado' => true,
                'idPadre' => 34
            ),
            array(
                'id_lista_grupo' => '3', 'nombre' => 'Practica',
                'codigo' => 'LINPRAC', 'valor' => '6', 'estado' => true,
                'idPadre' => 35
            ),
            array(
                'id_lista_grupo' => '6', 'nombre' => 'F-DC-124',
                'codigo' => '5FDC124', 'valor' => '2', 'estado' => true,
                'idPadre' => 5
            ),
            array(
                'id_lista_grupo' => '6', 'nombre' => 'F-DC-124',
                'codigo' => '32FDC124', 'valor' => '3', 'estado' => true,
                'idPadre' => 32
            ),
            array(
                'id_lista_grupo' => '6', 'nombre' => 'F-DC-124',
                'codigo' => '33FDC124', 'valor' => '4', 'estado' => true,
                'idPadre' => 33
            ),
            array(
                'id_lista_grupo' => '6', 'nombre' => 'F-DC-124',
                'codigo' => '34FDC124', 'valor' => '5', 'estado' => true,
                'idPadre' => 34
            ),
            array(
                'id_lista_grupo' => '6', 'nombre' => 'F-DC-126',
                'codigo' => '35FDC126', 'valor' => '6', 'estado' => true,
                'idPadre' => 35
            ),
            array(
                'id_lista_grupo' => '6', 'nombre' => 'F-DC-127',
                'codigo' => '35FDC1276', 'valor' => '7', 'estado' => true,
                'idPadre' => 35
            ),



            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-DC-125 - Informe Final',
                'codigo' => '5FDC125', 'valor' => '7', 'estado' => true,
                'idPadre' => 5
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-DC-129 - Rejilla de Evaluación',
                'codigo' => '5FDC129', 'valor' => '8', 'estado' => true,
                'idPadre' => 5
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-GC-01 - Licencia de Autorización Interna',
                'codigo' => '5FGC01', 'valor' => '9', 'estado' => true,
                'idPadre' => 5
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-GC-02 - Ficha de Metadatos',
                'codigo' => '5FGC02', 'valor' => '10', 'estado' => true,
                'idPadre' => 5
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'Exposición Trabajo de Grado',
                'codigo' => '5EXP01', 'valor' => '11', 'estado' => true,
                'idPadre' => 5
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'Otros Archivos de Sustentación',
                'codigo' => '5OTROS', 'valor' => '12', 'estado' => true,
                'idPadre' => 5
            ),



            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-DC-125 - Informe Final',
                'codigo' => '32FDC125', 'valor' => '13', 'estado' => true,
                'idPadre' => 32
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-DC-129 - Rejilla de Evaluación',
                'codigo' => '32FDC129', 'valor' => '14', 'estado' => true,
                'idPadre' => 32
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-GC-01 - Licencia de Autorización Interna',
                'codigo' => '32FGC01', 'valor' => '15', 'estado' => true,
                'idPadre' => 32
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-GC-02 - Ficha de Metadatos',
                'codigo' => '32FGC02', 'valor' => '16', 'estado' => true,
                'idPadre' => 32
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'Exposición Trabajo de Grado',
                'codigo' => '32EXP01', 'valor' => '17', 'estado' => true,
                'idPadre' => 32
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'Otros Archivos de Sustentación',
                'codigo' => '32OTROS', 'valor' => '18', 'estado' => true,
                'idPadre' => 32
            ),


            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-DC-125 - Informe Final',
                'codigo' => '33FDC125', 'valor' => '19', 'estado' => true,
                'idPadre' => 33
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-DC-129 - Rejilla de Evaluación',
                'codigo' => '33FDC129', 'valor' => '20', 'estado' => true,
                'idPadre' => 33
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-GC-01 - Licencia de Autorización Interna',
                'codigo' => '33FGC01', 'valor' => '21', 'estado' => true,
                'idPadre' => 33
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-GC-02 - Ficha de Metadatos',
                'codigo' => '33FGC02', 'valor' => '22', 'estado' => true,
                'idPadre' => 33
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'Exposición Trabajo de Grado',
                'codigo' => '33EXP01', 'valor' => '23', 'estado' => true,
                'idPadre' => 33
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'Otros Archivos de Sustentación',
                'codigo' => '33OTROS', 'valor' => '24', 'estado' => true,
                'idPadre' => 33
            ),



            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-DC-125 - Informe Final',
                'codigo' => '34FDC125', 'valor' => '25', 'estado' => true,
                'idPadre' => 34
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-DC-129 - Rejilla de Evaluación',
                'codigo' => '34FDC129', 'valor' => '26', 'estado' => true,
                'idPadre' => 34
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-GC-01 - Licencia de Autorización Interna',
                'codigo' => '34FGC01', 'valor' => '27', 'estado' => true,
                'idPadre' => 34
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-GC-02 - Ficha de Metadatos',
                'codigo' => '34FGC02', 'valor' => '28', 'estado' => true,
                'idPadre' => 34
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'Exposición Trabajo de Grado',
                'codigo' => '34EXP01', 'valor' => '29', 'estado' => true,
                'idPadre' => 34
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'Otros Archivos de Sustentación',
                'codigo' => '34OTROS', 'valor' => '30', 'estado' => true,
                'idPadre' => 34
            ),


            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-DC-128 - Informe Final',
                'codigo' => '35FGC02', 'valor' => '31', 'estado' => true,
                'idPadre' => 35
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'F-DC-129 - Rejilla de Evaluación',
                'codigo' => '35FDC129', 'valor' => '32', 'estado' => true,
                'idPadre' => 35
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'Exposición Trabajo de Grado',
                'codigo' => '35EXP01', 'valor' => '33', 'estado' => true,
                'idPadre' => 35
            ),
            array(
                'id_lista_grupo' => '7', 'nombre' => 'Otros Archivos de Sustentación',
                'codigo' => '35OTROS', 'valor' => '34', 'estado' => true,
                'idPadre' => 35
            ),

            array(
                'id_lista_grupo' => '3', 'nombre' => 'Proyecto de Investigacion',
                'codigo' => 'LINPROIN', 'valor' => '7', 'estado' => true,
                'idPadre' => 5
            ),


            array(
                'id_lista_grupo' => '7', 'nombre' => 'Prorroga',
                'codigo' => 'PRORROGA', 'valor' => '99', 'estado' => true,
                'idPadre' => 5
            ),


            array(
                'id_lista_grupo' => '7', 'nombre' => 'Prorroga',
                'codigo' => 'PRORROGA', 'valor' => '99', 'estado' => true,
                'idPadre' => 32
            ),


            array(
                'id_lista_grupo' => '7', 'nombre' => 'Prorroga',
                'codigo' => 'PRORROGA', 'valor' => '99', 'estado' => true,
                'idPadre' =>33
            ),


            array(
                'id_lista_grupo' => '7', 'nombre' => 'Prorroga',
                'codigo' => 'PRORROGA', 'valor' => '99', 'estado' => true,
                'idPadre' =>34
            ),


            array(
                'id_lista_grupo' => '7', 'nombre' => 'Prorroga',
                'codigo' => 'PRORROGA', 'valor' => '99', 'estado' => true,
                'idPadre' =>35
            ),
        );
        DB::table('listas')->insert($arr);
    }
}
