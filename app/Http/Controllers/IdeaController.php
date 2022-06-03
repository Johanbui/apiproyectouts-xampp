<?php

namespace App\Http\Controllers;

use App\Mail\NotifyMail;
use App\Models\Rol;
use App\Models\Acta;
use App\Models\File;
use App\Models\Idea;
use App\Models\User;
use App\Models\Lista;
use App\Models\IdeaEstado;
use App\Models\ListaGrupo;
use Illuminate\Http\Request;
use App\Models\IdeasArchivos;
use App\Models\IdeasUsuarios;
use App\Models\Notificaciones;
use Illuminate\Support\Facades\DB;
use App\Models\NotificacionesUsuarios;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class IdeaController extends Controller
{

    public function getAllInformes(Request $request)
    {
        $id_coordinacion = auth()->user()->id_coordinacion;
        $estado_idea = $request->get('estado_idea', '');
        $estudiantes = $request->get('estudiantes', '');
        $fecha_inicio = !empty($request->get('fecha_inicio')) ? Carbon::parse($request->get('fecha_inicio'))->format('Y-m-d') : '';
        $fecha_fin = !empty($request->get('fecha_fin')) ? Carbon::parse($request->get('fecha_fin'))->format('Y-m-d') : '';
        $modalidad = $request->get('modalidad', '');
        $linea_investigacion = $request->get('linea_investigacion', '');
        $search = $request->get('search', '');

        $subWhere = "
            ideas_estados.id = (
                SELECT ie.id
                FROM ideas_estados as ie
                WHERE ie.id_idea = ideas.id
                ORDER BY ie.created_at
                LIMIT 1
            ) OR ideas_estados.id IS NULL
        ";

        $subConsulta = DB::table('ideas_estados as ie')
                ->select('listas3.nombre')
                ->leftJoin('listas AS listas3', 'ie.id_codigo_estado', '=', 'listas3.id')
                ->whereRaw('ie.id_idea = ideas.id')
                ->orderByDesc('ie.created_at')
                ->limit(1)
                ->toSql();

        $ideas = Idea::query()
            ->select(
                'ideas.id',
                'titulo',
                'max_estudiantes',
                'listas.nombre AS nombreModalidad',
                'listas2.nombre AS nombreLineaInvestigacion',
                DB::raw('COUNT(ideas_usuarios.id_idea) AS cantidadUsuarios'),
                DB::raw("GROUP_CONCAT(users.name SEPARATOR ', ') AS usuarios"),
                DB::raw("($subConsulta) AS ultimoEstado")
            )
            ->join('listas', 'ideas.modalidad', '=', 'listas.id')
            ->join('listas AS listas2', 'ideas.linea_investigacion', '=', 'listas2.id')
            ->leftJoin('ideas_usuarios', 'ideas.id', '=', 'ideas_usuarios.id_idea')
            ->leftJoin('ideas_estados', 'ideas.id', '=', 'ideas_estados.id_idea')
            ->leftJoin('users', 'ideas_usuarios.id_usuario', '=', 'users.id')
            ->whereRaw($subWhere)
            ->groupBy('ideas.id')
            ;

        if ($id_coordinacion) {
            $ideas = $ideas->where('ideas.id_coordinacion', $id_coordinacion);
        }

        if ($estado_idea) {
            $ideas = $ideas->whereIn('ideas_estados.id_codigo_estado', $estado_idea);
        }

        if (!empty($fecha_inicio) && !empty($fecha_fin)) {
            $ideas = $ideas->whereBetween('ideas.created_at', [$fecha_inicio, $fecha_fin]);
        } elseif (!empty($fecha_inicio)) {
            $ideas = $ideas->whereDate('ideas.created_at', '>=', $fecha_inicio);
        } elseif (!empty($fecha_fin)) {
            $ideas = $ideas->whereDate('ideas.created_at', '<=', $fecha_fin);
        }

        if ($estudiantes) {
            $ideas = $ideas->whereIn('ideas_usuarios.id_usuario', $estudiantes);
        }

        if ($modalidad) {
            $ideas = $ideas->where('modalidad', $modalidad);
        }

        if ($linea_investigacion) {
            $ideas = $ideas->where('linea_investigacion', $linea_investigacion);
        }

        if ($search) {
            $ideas = $ideas->where(function ($query) use ($search) {
                $query->where('listas.nombre', 'LIKE', '%' . $search . '%');
                $query->orWhere('listas2.nombre', 'LIKE', '%' . $search . '%');
                $query->orWhere('titulo', 'LIKE', '%' . $search . '%');
            });
        }

        $ideas = $ideas->get();

        $countActas = Idea::count();

        return response()->json([
            "data" => $ideas,
            "type" => "success",
            "count" => $countActas,
            "code" => 20000
        ]);
    }

    public function getAll(Request $request)
    {
        $limit = $request->has('limit') ? $request->get('limit') : 99999999999999;
        $id_coordinacion = auth()->user()->id_coordinacion;

        $actas = Idea::query()
            ->select(
                DB::raw(
                'ideas.id,
                titulo,
                max_estudiantes,
                listas.nombre AS nombreModalidad,
                ideas.modalidad,
                ideas.linea_investigacion,
                listas2.nombre AS nombreLineaInvestigacion,
                COUNT(ideas_usuarios.id_idea ) AS cantidadUsuarios'
                )
            )
            ->join('listas', 'ideas.modalidad', '=', 'listas.id')
            ->join('listas AS listas2', 'ideas.linea_investigacion', '=', 'listas2.id')
            ->leftJoin('ideas_usuarios', 'ideas.id', '=', 'ideas_usuarios.id_idea')
            ->where('id_coordinacion', $id_coordinacion)
            ->groupBy('ideas.id')
            ->limit($limit)
            ->get();

        $countActas = Idea::count();

        return response()->json([
            "data" => $actas,
            "type" => "success",
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

        $IdeasArchivos =    IdeasArchivos::where('id_codigo_archivo', $request->get('id_codigo_archivo'))->where("id_idea", $request->get('id_idea'))->first();

        $ideasArchivos = new IdeasArchivos;
        $ideasArchivos->id_idea = $request->get('id_idea');
        $ideasArchivos->id_codigo_archivo = $request->get('id_codigo_archivo');
        $ideasArchivos->id_archivo = $request->get('id_archivo');

        if ($IdeasArchivos == null) {
            $ideasArchivos->save();
        } else {
            $IdeasArchivos->save();
        }

        return response()->json([
            "data" => $ideasArchivos,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);
    }

    public function createArchivoIdeasEvaluacion(Request $request)
    {
        $IdeasArchivos = IdeasArchivos::query()
            ->where('id_codigo_archivo', $request->get('id_codigo_archivo'))
            ->where("id_idea", $request->get('id_idea'))
            ->where("id_archivo", $request->get('id_file_propuesta'))
            ->first();


        $IdeasArchivos->id_file_confirmation = $request->get('id_archivo');
        $IdeasArchivos->save();

        return response()->json([
            "data" => $IdeasArchivos,
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

        $listaGrupo = ListaGrupo::where('codigo', $codigoListaGrupo)->first();

        $idListaGrupo = $listaGrupo->id;
        $listas = Lista::where('id_lista_grupo', $idListaGrupo)->get();


        for ($i = 0; $i < count($listas); $i++) {
            $lista =  $listas[$i];
            $IdeasArchivos = IdeasArchivos::where('id_codigo_archivo', $lista->id)->where("id_idea", $idIdea)
                ->first();
            if ($IdeasArchivos != null) {

                $id_file = $IdeasArchivos->id_archivo;
                $file = File::find($id_file);
                $file->url = "http://apiproyectouts.local/api/files/" . $id_file;
                $IdeasArchivos->file = $file;

                $id_file_confirmation = $IdeasArchivos->id_file_confirmation;
                if ($id_file_confirmation) {
                    $fileConfirmation = File::find($id_file_confirmation);
                    $file->url = "http://apiproyectouts.local/api/files/" . $id_file_confirmation;
                    $IdeasArchivos->fileConfirmation = $fileConfirmation;
                }

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

        $IdeasUsuarios =    IdeasUsuarios::where('tipoUsuario', $request->get('tipoUsuario'))->where("id_idea", $request->get('id_idea'))->first();

        $ideasUsuarios = new IdeasUsuarios;
        $ideasUsuarios->id_idea = $request->get('id_idea');
        $ideasUsuarios->id_usuario = $request->get('id_usuario');
        $ideasUsuarios->tipoUsuario = $request->get('tipoUsuario');

        if ($IdeasUsuarios == null) {
            $ideasUsuarios->save();
        } else {
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

        $listaGrupo = ListaGrupo::where('codigo', $codigoListaGrupo)->first();
        $idListaGrupo = $listaGrupo->id;
        $listas = Lista::where('id_lista_grupo', $idListaGrupo)->get();

        for ($i = 0; $i < count($listas); $i++) {
            $lista =  $listas[$i];
            $IdeasUsuarios =    IdeasUsuarios::where('tipoUsuario', $lista->id)->where("id_idea", $idIdea)
                ->get();

            for ($j = 0; $j < count($IdeasUsuarios); $j++) {
                $IdeaUsu = $IdeasUsuarios[$j];
                if ($IdeaUsu != null) {
                    $IdeaUsu->tipoUsuarioObj = $lista;
                    $user = User::find($IdeaUsu->id_usuario);
                    $IdeaUsu->id_usuarioObj = $user;
                    array_push($response, $IdeaUsu);
                }
            }
        }
        return response()->json([
            "data" => $response,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);
    }


    public function getEstudiantes()
    {

        $listas = DB::select(DB::raw("
                SELECT users.id, users.email,
                users.name,users.last_name,count(ideas_usuarios.id_usuario)-IFNULL(cantidadEstadoResultado,0) as cant
                FROM users
                INNER JOIN roles ON roles.id = users.rol_id
                LEFT JOIN ideas_usuarios ON users.id = ideas_usuarios.id_usuario
                LEFT  JOIN (
                SELECT  ideas_estados.id_idea, COUNT(*) cantidadEstadoResultado
                FROM ideas_estados
                where ideas_estados.id_codigo_estado IN (27,28,30)
                group by ideas_estados.id_idea
                )xx
                ON  ideas_usuarios.id_idea = xx.id_idea
                where roles.code = 'ESTUDIANTE'
                GROUP BY users.id,xx.cantidadEstadoResultado
            "), array());

        return response()->json([
            "data" => $listas,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);
    }
    public function createEstudiantesIdeas(Request $request)
    {
        $estudiantes =  $request->get('estudiantes');
        $id_idea =  $request->get('idIdea');

        $response = [];
        for ($i = 0; $i < count($estudiantes); $i++) {
            $estudiante = json_decode($estudiantes[$i]);
            $IdeasUsuarios = IdeasUsuarios::firstOrCreate(
                [
                    'id_idea'  => $id_idea,
                    "id_usuario" => $estudiante->id,
                    "tipoUsuario" => $estudiante->tipoUsuario
                ]
            );
            array_push($response, $IdeasUsuarios);
        }


        return response()->json([
            "data" => $response,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);
    }


    public function createArrArchivoIdeas(Request $request)
    {


        $archivos =  $request->get('archivos');
        $id_idea =  $request->get('idIdea');

        for ($i = 0; $i < count($archivos); $i++) {
            $archivo = json_decode($archivos[$i]);

            if ($archivo->id_file != null) {
                $IdeasArchivos =    IdeasArchivos::where('id_codigo_archivo', $archivo->id_codigo_archivo)
                    ->where("id_idea", $id_idea)
                    ->first();

                $ideasArchivos = new IdeasArchivos;
                $ideasArchivos->id_idea = $id_idea;
                $ideasArchivos->id_codigo_archivo = $archivo->id_codigo_archivo;
                $ideasArchivos->id_archivo = $archivo->id_file;

                if ($IdeasArchivos == null) {
                    $ideasArchivos->save();
                } else {
                    $IdeasArchivos->id_archivo = $archivo->id_file;
                    $IdeasArchivos->save();
                }
            }
        }

        return response()->json([
            "data" => "",
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);
    }

    public function createArrArchivoIdeasEvaluacion(Request $request)
    {

        $archivos =  $request->get('archivos');
        $id_idea =  $request->get('idIdea');

        for ($i = 0; $i < count($archivos); $i++) {
            $archivo = json_decode($archivos[$i]);

            if ($archivo->id_file_propuesta != null) {

                $IdeasArchivos =
                    IdeasArchivos::where('id_codigo_archivo', $archivo->id_codigo_archivo)
                    ->where("id_idea", $id_idea)
                    ->first();

                $ideasArchivos = new IdeasArchivos;
                $ideasArchivos->id_idea = $id_idea;
                $ideasArchivos->id_codigo_archivo = $archivo->id_codigo_archivo;
                $ideasArchivos->id_file_confirmation = $archivo->id_file_propuesta;
                $ideasArchivos->id_archivo = null;

                if ($IdeasArchivos == null) {
                    $ideasArchivos->save();
                } else {
                    $IdeasArchivos->id_file_confirmation = $archivo->id_file_propuesta;
                    $IdeasArchivos->save();
                }
            }
        }

        return response()->json([
            "data" => "",
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);
    }



    public function getArrArchivoIdeas(Request $request)
    {
        $response = [];

        $codigoListaGrupo = $request->get('codigoListaGrupo');
        $idIdea = $request->get('idIdea');

        $listaGrupo = ListaGrupo::where('codigo', $codigoListaGrupo)->first();

        $idListaGrupo = $listaGrupo->id;

        $idea = Idea::find( $idIdea);
        $listas =   Lista::where('id_lista_grupo', $idListaGrupo)
                    ->where('idPadre',$idea->modalidad)

                    ->get();

        for ($i = 0; $i < count($listas); $i++) {
            $lista =  $listas[$i];
            $IdeasArchivos = IdeasArchivos::where('id_codigo_archivo', $lista->id)->where("id_idea", $idIdea)
                ->first();

            if ($IdeasArchivos !== null) {

                if ($IdeasArchivos->id_archivo !== null) {
                    $id_file = $IdeasArchivos->id_archivo;
                    $file = File::find($id_file);
                    $file->url = "http://apiproyectouts.local/api/files/" . $id_file;
                    $IdeasArchivos->file = $file;
                } else {
                    $IdeasArchivos->file = null;
                }

                $id_file_confirmation = $IdeasArchivos->id_file_confirmation;
                if ($id_file_confirmation !== null) {
                    $fileConfirmation = File::find($id_file_confirmation);
                    $file->url = "http://apiproyectouts.local/api/files/" . $id_file_confirmation;
                    $IdeasArchivos->fileConfirmation = $fileConfirmation;
                } else {
                    $IdeasArchivos->fileConfirmation = null;
                }
                $IdeasArchivos->listaNombre = $lista->nombre;
                $IdeasArchivos->listaCodigo = $lista->codigo;

                array_push($response, $IdeasArchivos);
            } else {
                $IdeasArchivo = new IdeasArchivos();
                $IdeasArchivo->id_codigo_archivo = $lista->id;
                $IdeasArchivo->id_codigo_archivo = $lista->id;
                $IdeasArchivo->id_file =  null;
                $IdeasArchivo->id_file_propuesta =  null;
                $IdeasArchivo->id_file_confirmation =  null;
                $IdeasArchivo->file = null;
                $IdeasArchivo->id = null;
                $IdeasArchivo->fileConfirmation = null;
                $IdeasArchivo->listaNombre = $lista->nombre;
                $IdeasArchivo->listaCodigo = $lista->codigo;
                array_push($response, $IdeasArchivo);
            }
        }
        return response()->json([
            "data" => $response,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);
    }

    public function getIdeaUsuario(Request $request)
    {
        $id_usuario = $request->get('id_usuario');

        $IdeasUsuarios = IdeasUsuarios::where("id_usuario", $id_usuario)
            ->get();

        for ($i = 0; $i < count($IdeasUsuarios); $i++) {
            $IdeasEstado = IdeaEstado::where("id_idea", $IdeasUsuarios[$i]->id_idea)
                ->whereIn("id_codigo_estado", [27, 28, 30])
                ->get();
            $count = $IdeasEstado->count();
            $IdeasUsuarios[$i]->cant =  $count;
            $IdeasUsuarios[$i]->codigoLista =  (count($IdeasEstado) > 0) ? $IdeasEstado[0]->id_codigo_estado : null;
        }

        return response()->json([
            "data" => $IdeasUsuarios,
            "code" => 20000
        ]);
    }

    public function createIdeaEstado(Request $request)
    {
        $acta = $request->get('acta');
        $comentario = $request->get('comentario') ?? '';
        $actaObj = Acta::where('codigo', $acta)->first();

        if (!$actaObj && trim($acta) !== "") {

            return response()->json([
                "data" => false,
                "exist" => false,
                "code" => 20000,
                "message" => "Acta no existe!",
                "type" => "success"
            ]);
        }

        $codigo_estado = $request->get('codigo_estado');

        $idCodigoEstado = Lista::query()
            ->where('codigo', $codigo_estado)
            ->first();

        if ($idCodigoEstado) {
            $id_idea = $request->get('id_idea');

            $response = IdeaEstado::firstOrCreate(
                [
                    'id_idea' => $id_idea,
                    'id_codigo_estado' => $idCodigoEstado->id,
                    'id_acta' => ($actaObj) ? $actaObj->id : 0,
                    'id_idea' => $id_idea,
                ],
                [
                    'comentario' => $comentario
                ]
            );

            $this->crearNotificacion($response);

            return response()->json([
                "data" => $response,
                "exist" => true,
                "code" => 20000,
                "message" => "Created Succefully!",
                "type" => "success"
            ]);
        }

        return response()->json([
            "data" => false,
            "exist" => true,
            "code" => 20000,
            "message" => "No existe Estado",
            "type" => "success"
        ]);
    }


    public function getIdeaEstado(Request $request)
    {

        $codigo_estado = $request->get('codigo_estado');

        $idCodigoEstado = Lista::query()
            ->where('codigo', $codigo_estado)
            ->first();

        if ($idCodigoEstado || $codigo_estado == "RESULTADO") {

            $id_idea = $request->get('id_idea');
            $response = null;
            $SQL = IdeaEstado::where('id_idea', $id_idea);

            if (
                $codigo_estado != "PROEIDEA"
                && $codigo_estado != "APREIDEA"
                && $codigo_estado != "CANEIDEA"
                && $codigo_estado != "EJECIDEA"
                && $codigo_estado != "EXPIDEA"
                && $codigo_estado != "RESULTADO"
            ) {

                $response = $SQL->where('id_codigo_estado', $idCodigoEstado->id)
                    ->first();
                if ($response) {
                    $response->codigoEstado = $idCodigoEstado->codigo;
                } else {
                    return response()->json([
                        "data" => null,
                        "exist" => false,
                        "code" => 20000,
                        "message" => "No existe Estado",
                        "type" => "success"
                    ]);
                }
            } else {
                $response =  $SQL->whereIn('id_codigo_estado', [26, 27, 28, 29, 30])
                    ->latest()->first();

                if ($response) {
                    $idCodigoEstado2 = Lista::find($response->id_codigo_estado);
                    $response->codigoEstado = $idCodigoEstado2->codigo;
                } else {
                    return response()->json([
                        "data" => null,
                        "exist" => false,
                        "code" => 20000,
                        "message" => "No existe Estado",
                        "type" => "success"
                    ]);
                }
            }

            if ($response) {
                return response()->json([
                    "data" => $response,
                    "exist" => true,
                    "code" => 20000,
                    "message" => "Created Succefully!",
                    "type" => "success"
                ]);
            }
            return response()->json([
                "data" => null,
                "exist" => false,
                "code" => 20000,
                "message" => "No existe Estado",
                "type" => "success"
            ]);
        }

        return response()->json([
            "data" => null,
            "exist" => false,
            "code" => 20000,
            "message" => "No existe Estado",
            "type" => "success"
        ]);
    }

    public function crearNotificacion(IdeaEstado $ideaEstado)
    {

        $idea = Idea::find($ideaEstado->id_idea);
        $tituloIdea = $idea->titulo;

        $lista = Lista::find($ideaEstado->id_codigo_estado);

        $notificacion =  new Notificaciones();
        $asunto = "La idea " . $tituloIdea . " Se le asignó el estado en " . $lista->nombre;
        $response = $notificacion::firstOrCreate(
            [
                'tipo'  => 1,
                "valor" => $ideaEstado->id_codigo_estado
            ],
            [
                'icon'  => "",
                "html" => "",
                "url" => "",
                'title' => $asunto,
                "visto" => false
            ]
        );

        if ($response->wasRecentlyCreated === true) {

            $ideasUsuarios = IdeasUsuarios::where("id_idea", $ideaEstado->id_idea)->get();

            for ($i = 0; $i < count($ideasUsuarios); $i++) {
                $notificacionUsuario = new NotificacionesUsuarios();

                $notificacionUsuario::firstOrCreate(
                    [
                        'id_notificacion'  => $response->id,
                        'id_usuario' => $ideasUsuarios[$i]->id_usuario,
                    ]
                );
            }
            if ($ideaEstado->comentario != "") {

                $emailsUsuarios = IdeasUsuarios::query()
                    ->select('email')
                    ->join('users', 'ideas_usuarios.id_usuario', '=', 'users.id')
                    ->where('id_idea', $ideaEstado->id_idea)
                    ->pluck('email')
                    ->all();
                foreach ($emailsUsuarios as $email) {
                    $this->enviarCorreo($email,  $asunto, $ideaEstado->comentario);
                }
            }
        }
        return  $response;
    }

    public function enviarCorreo($email, $asunto, $cuerpo)
    {
        $arrayInfo['cuerpo'] = $cuerpo;

        Mail::to($email)->send(new NotifyMail($arrayInfo, $asunto));

        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        } else {
            return null;
        }
    }


    public function getResultadoProyecto(Request $request)
    {


        $id_idea = $request->get('id_idea');
        $SQL = IdeaEstado::where('id_idea', $id_idea);


        $response =  $SQL->whereIn('id_codigo_estado', [26, 27, 28, 30])
            ->latest()->first();

        if ($response) {
            $idCodigoEstado2 = Lista::find($response->id_codigo_estado);
            $response->codigoEstado = $idCodigoEstado2->codigo;
            $response->codigoNombre = $idCodigoEstado2->nombre;
            return response()->json([
                "data" => $response,
                "exist" => true,
                "code" => 20000,
                "message" => "Created Succefully!",
                "type" => "success"
            ]);
        } else {
            return response()->json([
                "data" => null,
                "exist" => false,
                "code" => 20000,
                "message" => "No existe Estado",
                "type" => "success"
            ]);
        }
    }

    public function getLastEstadoProyecto(Request $request)
    {


        $id_idea = $request->get('id_idea');
        $SQL = IdeaEstado::where('id_idea', $id_idea);
        $response =  $SQL->latest()->first();

        if ($response) {
            $idCodigoEstado2 = Lista::find($response->id_codigo_estado);
            $response->codigoEstado = $idCodigoEstado2->codigo;
            return response()->json([
                "data" => $response,
                "exist" => true,
                "code" => 20000,
                "message" => "Created Succefully!",
                "type" => "success"
            ]);
        } else {
            return response()->json([
                "data" => null,
                "exist" => false,
                "code" => 20000,
                "message" => "No existe Estado",
                "type" => "success"
            ]);
        }
    }


    public function getIdeaEstadoExist(Request $request)
    {


        $codigo_estado = $request->get('codigo_estado');

        $idCodigoEstado = Lista::query()
            ->where('codigo', $codigo_estado)
            ->first();

        if ($idCodigoEstado) {

            $id_idea = $request->get('id_idea');
            $response = null;
            $SQL = IdeaEstado::where('id_idea', $id_idea);
            $response = $SQL->where('id_codigo_estado', $idCodigoEstado->id)
                ->first();
            if ($response) {
                $response->codigoEstado = $idCodigoEstado->codigo;
            } else {
                return response()->json([
                    "data" => null,
                    "exist" => false,
                    "code" => 20000,
                    "message" => "No existe Estado",
                    "type" => "success"
                ]);
            }


            if ($response) {
                return response()->json([
                    "data" => $response,
                    "exist" => true,
                    "code" => 20000,
                    "message" => "Created Succefully!",
                    "type" => "success"
                ]);
            }
        }

        return response()->json([
            "data" => null,
            "exist" => false,
            "code" => 20000,
            "message" => "No existe Estado",
            "type" => "success"
        ]);
    }

    public function getIdeaEstadoActa(Request $request)
    {

        $codigo_estado = $request->get('codigo_estado');
        $idCodigoEstado = Lista::query()
            ->where('codigo', $codigo_estado)
            ->first();

        $id_idea = $request->get('id_idea');


        $ideaEstado = IdeaEstado::where('id_idea', $id_idea)
            ->where('id_codigo_estado', $idCodigoEstado->id)
            ->first();

        $response = Acta::find($ideaEstado->id_acta);

        if ($response) {
            return response()->json([
                "data" => $response,
                "exist" => true,
                "code" => 20000,
                "message" => "Created Succefully!",
                "type" => "success"
            ]);
        }
        return response()->json([
            "data" => null,
            "exist" => false,
            "code" => 20000,
            "message" => "No existe Estado",
            "type" => "success"
        ]);
    }
}
