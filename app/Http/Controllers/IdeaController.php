<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Acta;
use App\Models\File;
use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function __construct()
    {
    }

    public function getAll(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 99999999999999;
        $search = $request->has('search') ? $request->get('search') : '';


        $actas = Idea::limit($limit)
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
        $actaId = $request->has('id') ? $request->get('id') : 0;
        $acta = Idea::find($actaId);
        $id_file = $acta->file_id;
        $file = File::find($id_file);
        $file->url = "http://apiproyectouts.local/api/files/".$id_file;
        $acta->file =  $file;

        return response()->json([
            "data" => $acta,
            "code" => 20000
        ]);
    }

    public function update(Request $request)
    {


        $actaId = $request->has('id') ? $request->get('id') : 0;
        $codigo = $request->has('codigo') ? $request->get('codigo') : 0;
        $file_id = $request->has('file_id') ? $request->get('file_id') : 0;

        $acta = Idea::find($actaId);
        $acta->codigo = $codigo;
        $acta->file_id = $file_id;
        $acta->save();

        return response()->json([
            "data" => $acta,
            "code" => 20000
        ]);
    }

    public function create(Request $request)
    {

        $acta = new Idea;
        $acta->titulo = $request->get('titulo');
        $acta->max_estudiantes = $request->get('max_estudiantes');
        $acta->save();

        return response()->json([
            "data" => $acta,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);

    }

}
