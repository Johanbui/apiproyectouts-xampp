<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\Blog;
use App\Models\Lista;
use App\Models\ListaGrupo;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    public function __construct()
    {
    }


    public function getAll(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 99999999999999;
        $search = $request->has('search') ? $request->get('search') : '';


        $listaGrupos = ListaGrupo::where('codigo', 'LIKE', '%' . $search . '%')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->get();

        foreach ($listaGrupos as $listaGrupo) {
            $idListaGrupo = $listaGrupo->id;
            $listas = Lista::find($idListaGrupo);
            $listaGrupo->listas =  $listas;
        }

        $countActas = ListaGrupo::where('codigo', 'LIKE', '%' . $search . '%')
            ->count();

        return response()->json([
            "data" => $listaGrupos,
            "type" => "success",
            "count" => $countActas,
            "code" => 20000
        ]);

    }

    public function getEstados() {
        $idEstadoIdea = ListaGrupo::query()
            ->where('codigo', '=', 'ESTIDEA')
            ->value('id');

        if ($idEstadoIdea) {
            $estadosIdea = Lista::query()
                ->where('id_lista_grupo', $idEstadoIdea)
                ->get();

            return response()->json([
                "data" => $estadosIdea,
                "type" => "success",
                "code" => 20000
            ]);
        }

        return response()->json([
            "data" => [],
            "type" => "failed",
            "code" => 50000
        ]);
    }

    public function getOne(Request $request)
    {
        $codigoListaGrupo = $request->has('codigo') ? $request->get('codigo') : 0;
        $idPadreLista = $request->has('idPadre') ? $request->get('idPadre') : 0;

        $listaGrupo = ListaGrupo::where('codigo',$codigoListaGrupo)->first();
        $idListaGrupo = $listaGrupo->id;
         $SQL = Lista::where('id_lista_grupo',$idListaGrupo);

        if($idPadreLista !=="" && $idPadreLista !==0 && !empty($idPadreLista)){
            $SQL->where('idPadre',$idPadreLista);
        }

        $listas = $SQL->get();
        return response()->json([
            "data" => $listas,
            "code" => 20000
        ]);
    }
}
