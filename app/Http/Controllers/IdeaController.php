<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Acta;
use App\Models\File;
use App\Models\Idea;
use App\Models\User;
use App\Models\Lista;
use App\Models\ListaGrupo;
use Illuminate\Http\Request;
use App\Models\IdeasArchivos;
use App\Models\IdeasUsuarios;

class IdeaController extends Controller
{

    public function getAll(Request $request)
    {
        $limit = $request->has('limit') ? $request->get('limit') : 99999999999999;
        $id_coordinacion = auth()->user()->id_coordinacion;

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
            ->where('id_coordinacion', $id_coordinacion)
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

    public function getDirectores()
    {
        $listas = User::query()
            ->select(
                'users.id',
                'users.name',
                'users.last_name'
            )
            ->join('roles', 'roles.id', '=', 'users.rol_id')
            ->where('roles.code', 'DOCENTE')
            ->get();

        return response()->json([
            "data" => $listas,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);
    }

    public function createArchivoIdeas(Request $request)
    {

        $IdeasArchivos =    IdeasArchivos::
        where('id_codigo_archivo',$request->get('id_codigo_archivo'))->
        where("id_idea",$request->get('id_idea'))->first();

        $ideasArchivos = new IdeasArchivos;
        $ideasArchivos->id_idea = $request->get('id_idea');
        $ideasArchivos->id_codigo_archivo = $request->get('id_codigo_archivo');
        $ideasArchivos->id_archivo = $request->get('id_archivo');

        if($IdeasArchivos == null){
            $ideasArchivos->save();
        }else{
            $IdeasArchivos->id_archivo = $request->get('id_archivo');
            $IdeasArchivos->save();
        }

        return response()->json([
            "data" => $ideasArchivos,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);
    }

    public function getArchivoIdeas(Request $request)
    {
        $response = [];

        $codigoListaGrupo = $request->get('codigoListaGrupo');
        $idIdea = $request->get('idIdea');

        $listaGrupo = ListaGrupo::where('codigo',$codigoListaGrupo)->first();
        $idListaGrupo = $listaGrupo->id;
        $listas = Lista::where('id_lista_grupo',$idListaGrupo)->get();

        for ($i=0; $i < count($listas); $i++) {
            $lista =  $listas[$i];
            $IdeasArchivos =    IdeasArchivos::
                                where('id_codigo_archivo',$lista->id)->
                                where("id_idea",$idIdea)
            ->first();
            if($IdeasArchivos != null){

                $id_file = $IdeasArchivos->id_archivo;
                $file = File::find($id_file);
                $file->url = "http://apiproyectouts.local/api/files/".$id_file;
                $IdeasArchivos->file = $file;
                array_push($response, $IdeasArchivos);
            }
        }
        return response()->json([
            "data" => $response,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);
    }

    public function createUsuariosIdeas(Request $request)
    {

        $IdeasUsuarios =    IdeasUsuarios::
        where('tipoUsuario',$request->get('tipoUsuario'))->
        where("id_idea",$request->get('id_idea'))->first();

        $ideasUsuarios = new IdeasUsuarios;
        $ideasUsuarios->id_idea = $request->get('id_idea');
        $ideasUsuarios->id_usuario = $request->get('id_usuario');
        $ideasUsuarios->tipoUsuario = $request->get('tipoUsuario');

        if($IdeasUsuarios == null){
            $ideasUsuarios->save();
        }else{
            $IdeasUsuarios->id_usuario = $request->get('id_usuario');
            $IdeasUsuarios->save();
        }

        return response()->json([
            "data" => $IdeasUsuarios,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);
    }

    public function getUsuariosIdeas(Request $request)
    {
        $response = [];

        $codigoListaGrupo = $request->get('codigoListaGrupo');
        $idIdea = $request->get('idIdea');

        $listaGrupo = ListaGrupo::where('codigo',$codigoListaGrupo)->first();
        $idListaGrupo = $listaGrupo->id;
        $listas = Lista::where('id_lista_grupo',$idListaGrupo)->get();

        for ($i=0; $i < count($listas); $i++) {
            $lista =  $listas[$i];
            $IdeasUsuarios =    IdeasUsuarios::
                                where('tipoUsuario',$lista->id)->
                                where("id_idea",$idIdea)
                                ->first();

            if($IdeasUsuarios != null){
                $IdeasUsuarios->tipoUsuarioObj = $lista;
                $user = User::find($IdeasUsuarios->id_usuario);
                $IdeasUsuarios->id_usuarioObj = $user;
                array_push($response, $IdeasUsuarios);
            }

        }
        return response()->json([
            "data" => $response,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);
    }

}
