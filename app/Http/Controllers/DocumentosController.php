<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Documentos;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DocumentosController extends Controller
{
    public function __construct()
    {
    }

    public function getAll(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 99999999999999;
        $search = $request->has('search') ? $request->get('search') : '';


        $documentoss = documentos::where('codigo', 'LIKE', '%' . $search . '%')
            ->limit($limit)
            ->offset(($page - 1) * $limit)
            ->get();

        foreach ($documentoss as $documentos) {
            $id_file = $documentos->file_id;
            $file = File::find($id_file);
            $file->url = "http://192.168.10.242/apiproyectouts/public/api/files/".$id_file;
            $documentos->file =  $file;
        }

        $countdocumentoss = documentos::where('codigo', 'LIKE', '%' . $search . '%')
            ->count();

        return response()->json([
            "data" => $documentoss,
            "count" => $countdocumentoss,
            "code" => 20000
        ]);
    }

    public function getone(Request $request)
    {
        $documentosId = $request->has('id') ? $request->get('id') : 0;
        $documentos = documentos::find($documentosId);
        $id_file = $documentos->file_id;
        $file = File::find($id_file);
        $file->url = "http://192.168.10.242/apiproyectouts/public/api/files/".$id_file;
        $documentos->file =  $file;

        return response()->json([
            "data" => $documentos,
            "code" => 20000
        ]);
    }

    public function update(Request $request)
    {
        $fecha = Carbon::parse( $request->get('fecha'));
        $fecha = $fecha->format('Y-m-d H:i:s');

        $documentosId = $request->has('id') ? $request->get('id') : 0;
        $codigo = $request->has('codigo') ? $request->get('codigo') : 0;
        $file_id = $request->has('file_id') ? $request->get('file_id') : 0;

        $documentos = documentos::find($documentosId);
        $documentos->codigo = $codigo;
        $documentos->file_id = $file_id;
        $documentos->fecha = $fecha;
        $documentos->save();

        return response()->json([
            "data" => $documentos,
            "code" => 20000
        ]);
    }

    public function create(Request $request)
    {
        $fecha = Carbon::parse( $request->get('fecha'));
        $fecha = $fecha->format('Y-m-d H:i:s');

        $documentos = new documentos;
        $documentos->codigo = $request->get('codigo');
        $documentos->file_id = $request->get('file_id');
        $documentos->fecha = $fecha;
        $documentos->save();

        return response()->json([
            "data" => $documentos,
            "code" => 20000,
            "message" => "Created Succefully!",
            "type" => "success"
        ]);

    }
}
