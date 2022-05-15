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
        );

        DB::table('listas_grupos')->insert($arr);

        $arr = array(
            array(
                'id_lista_grupo' => '1', 'nombre' => 'Cédula Ciudadanía',
                'codigo' => 'CC', 'valor' => '1', 'estado' => true
            ),
            array(
                'id_lista_grupo' => '1', 'nombre' => 'Cédula Extranjería',
                'codigo' => 'CE', 'valor' => '2', 'estado' => true
            ),
            array(
                'id_lista_grupo' => '1', 'nombre' => 'Nit',
                'codigo' => 'NIT', 'valor' => '3', 'estado' => true
            ),
            array(
                'id_lista_grupo' => '2', 'nombre' => 'Desarrollo de Software',
                'codigo' => 'DESSOF', 'valor' => '1', 'estado' => true
            ),
            array(
                'id_lista_grupo' => '2', 'nombre' => 'Proyecto de Investigación',
                'codigo' => 'PROINV', 'valor' => '2', 'estado' => true
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
                'codigo' => 'TDSI', 'valor' => '1', 'estado' => true
            ),
            array(
                'id_lista_grupo' => '4', 'nombre' => 'Ingenieria de Sistemas',
                'codigo' => 'INGS', 'valor' => '2', 'estado' => true
            ),
            array(
                'id_lista_grupo' => '5', 'nombre' => 'Estudiante',
                'codigo' => 'EST', 'valor' => '1', 'estado' => true
            ),
            array(
                'id_lista_grupo' => '5', 'nombre' => 'Director',
                'codigo' => 'DIR', 'valor' => '2', 'estado' => true
            ),
            array(
                'id_lista_grupo' => '5', 'nombre' => 'CO/Director',
                'codigo' => 'CODIR', 'valor' => '3', 'estado' => true
            )
        );
        DB::table('listas')->insert($arr);
    }
}
