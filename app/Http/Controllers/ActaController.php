<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Acta;
use Illuminate\Http\Request;

class ActaController extends Controller
{
    public function __construct()
    {
    }

    public function getAll(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 99999999999999;
        $search = $request->has('search') ? $request->get('search') : '';


        $actas = Acta::where('url_archivo', 'LIKE', '%' . $search . '%')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->get();

        $countActas = Acta::where('url_archivo', 'LIKE', '%' . $search . '%')
            ->count();

        return response()->json([
            "data" => $actas,
            "count" => $countActas,
            "code" => 20000
        ]);
    }

    public function getone(Request $request)
    {
        $actaId = $request->has('id') ? $request->get('id') : 0;
        $acta = Acta::find($actaId);

        return response()->json([
            "data" => $acta,
            "code" => 20000
        ]);
    }

    public function update(Request $request)
    {


        $actaId = $request->has('id') ? $request->get('id') : 0;
        $codigo = $request->has('codigo') ? $request->get('codigo') : 0;
        $url_archivo = $request->has('url_archivo') ? $request->get('url_archivo') : 0;

        $acta = Acta::find($actaId);
        $acta->codigo = $codigo;
        $acta->url_archivo = $url_archivo;
        $acta->save();

        return response()->json([
            "data" => $acta,
            "code" => 20000
        ]);
    }

    public function create(Request $request)
    {

        $acta = new Acta;
        $acta->codigo = $request->get('codigo');
        $acta->url_archivo = $request->get('url_archivo');
        $acta->save();

        return response()->json([
            "data" => $acta,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);

    }

}
