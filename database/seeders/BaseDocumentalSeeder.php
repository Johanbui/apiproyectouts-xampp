<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaseDocumentalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now(); // Obtener la fecha actual
        //files
        $arr = array(
            array('name' => 'F-DC-124 Propuesta trabajo grado  Investigación, Desarrollo Tecnológico, Monografía y Emprendimiento V2.doc', 'path'=> 'public/files/Basedocumental/F-DC-124', 'mime_type' => 'application/msword','size' => '875008'),

            array(
            'name' => 'F-AM-04 Solicitud Grado V17.docx',
            'path' => 'public/files/Basedocumental/F-AM-04.docx',
            'mime_type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'size' => '36432',

        ),

            array(
                'name' => 'F-DC-125  Informe final trabajo grado modalidad proyecto de investigación, desarrollo tecnológico, monografía, emprendimiento y seminario V2.docx',
                'path' => 'public/files/Basedocumental/F-DC-125.docx',
                'mime_type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'size' => '148952',

            ),
            array(
                'name' => 'F-DC-127 Propuesta de trabajo de grado_ Modalidad Práctica  V2.doc',
                'path' => 'public/files/Basedocumental/F-DC-127.docx',
                'mime_type' => 'application/msword',
                'size' => '846336',

            ),
            array(
                'name' => 'F-DC-128 Informe final de trabajo de grado en modalidad de práctica V2.docx',
                'path' => 'public/files/Basedocumental/F-DC-128.docx',
                'mime_type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'size' => '216835',

            ),
            array(
                'name' => 'F-DC-129 Rejilla de evaluación informe final de trabajo de grado V2.docx',
                'path' => 'public/files/Basedocumental/F-DC-129.docx',
                'mime_type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'size' => '44684',

            ),
            array(
                'name' => 'F-DC-130 Concepto final del trabajo de grado V2.docx',
                'path' => 'public/files/Basedocumental/F-DC-130.docx',
                'mime_type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'size' => '46947',

            ),
            array(
                'name' => 'F-DC-196 Acta de Terminación y Recibo a Satisfacción de Prácticas V2.doc',
                'path' => 'public/files/Basedocumental/F-DC-196.docx',
                'mime_type' => 'application/msword',
                'size' => '68096',

            ),
            array(
                'name' => 'Autorización de datos sensibles.docx',
                'path' => 'public/files/Basedocumental/Autorizacion.docx',
                'mime_type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'size' => '13415',

            ),
        );



        DB::table('files')->insert($arr);




        //documentos

        $arr = array(



           array(
            'codigo' => 'F-AM-04',
            'fecha' => now(),
            'file_id' => '2',

        ),

        array(
            'codigo' => 'F-DC-124',
            'fecha' => now(),
            'file_id' => '1',

        ),

        array(
            'codigo' => 'F-DC-125',
            'fecha' => now(),
            'file_id' => '3',

        ),

        array(
            'codigo' => 'F-DC-127',
            'fecha' => now(),
            'file_id' => '4',

        ),


        array(
            'codigo' => 'F-DC-128',
            'fecha' => now(),
            'file_id' => '5',

        ),


        array(
            'codigo' => 'F-DC-129',
            'fecha' => now(),
            'file_id' => '6',

        ),
        array(
            'codigo' => 'F-DC-130',
            'fecha' => now(),
            'file_id' => '7',

        ),
        array(
            'codigo' => 'F-DC-196',
            'fecha' => now(),
            'file_id' => '8',

        ),
        array(
            'codigo' => 'Autorizacion',
            'fecha' => now(),
            'file_id' => '9',

        ),


        );



        DB::table('documentos')->insert($arr);
    }
}
