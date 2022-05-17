<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Acta;
use App\Models\File;
use App\Models\Idea;
use App\Models\Lista;
use App\Models\ListaGrupo;
use Illuminate\Http\Request;

class IdeaController extends Controller
{

    public function getAll(Request $request)
    {
        $limit = $request->has('limit') ? $request->get('limit') : 99999999999999;

        $actas = Idea::query()
            ->select(
                'ideas.id',
                'titulo',
                'max_estudiantes',
                'listas.nombre AS nombreModalidad',
                'listas2.nombre AS nombreLineaInvestigacion'
            )
            ->join('listas', 'ideas.modalidad', '=', 'listas.id')
            ->join('listas AS listas2', 'ideas.linea_investigacion', '=', 'listas2.id')
            ->limit($limit)
            ->get();

        $countActas = Idea::count();

        return response()->json([
            "data" => $actas,
            "count" => $countActas,
            "code" => 20000
        ]);
    }

    public function getone(Request $request)
    {
        $ideaId = $request->has('id') ? $request->get('id') : 0;
        $idea = Idea::find($ideaId);

        return response()->json([
            "data" => $idea,
            "code" => 20000
        ]);
    }

    public function update(Request $request)
    {
        $idIdea = $request->has('id') ? $request->get('id') : 0;
        $titulo = $request->has('titulo') ? $request->get('titulo') : '';
        $modalidad = $request->has('modalidad') ? $request->get('modalidad') : 1;
        $linea_investigacion = $request->has('linea_investigacion') ? $request->get('linea_investigacion') : 1;
        $max_estudiantes = $request->has('max_estudiantes') ? $request->get('max_estudiantes') : 1;

        $idea = Idea::find($idIdea);
        $idea->titulo = $titulo;
        $idea->modalidad = $modalidad;
        $idea->linea_investigacion = $linea_investigacion;
        $idea->max_estudiantes = $max_estudiantes;
        $idea->save();

        return response()->json([
            "data" => $idea,
            "code" => 20000
        ]);
    }

    public function create(Request $request)
    {
        $acta = new Idea;
        $acta->titulo = $request->get('titulo');
        $acta->modalidad = $request->get('modalidad');
        $acta->linea_investigacion = $request->get('linea_investigacion');
        $acta->max_estudiantes = $request->get('max_estudiantes');
        $acta->save();

        return response()->json([
            "data" => $acta,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);
    }

    public function getModalidades()
    {
        $idListaGrupo = ListaGrupo::where('codigo', 'MODGRA')->first();
        $listas = Lista::where('id_lista_grupo', $idListaGrupo->id)->get();

        return response()->json([
            "data" => $listas,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);
    }

    public function getLineasInvestigacion()
    {
        $idListaGrupo = ListaGrupo::where('codigo', 'LININV')->first();
        $listas = Lista::where('id_lista_grupo', $idListaGrupo->id)->get();

        return response()->json([
            "data" => $listas,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);
    }

}
