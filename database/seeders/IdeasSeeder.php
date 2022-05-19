<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Idea;

class IdeasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idea = new Idea();
        $idea->titulo = 'Desarrollo Software Trabajos de Grado';
        $idea->modalidad = 4;
        $idea->linea_investigacion = 7;
        $idea->max_estudiantes = 2;
        $idea->id_coordinacion = 9;
        $idea->save();
    }
}
