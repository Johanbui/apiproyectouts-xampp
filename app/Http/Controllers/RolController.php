<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function __construct()
    {
    }

    public function getAll(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $search = $request->has('search') ? $request->get('search') : '';


        $roles = Rol::where('code','LIKE','%'.$search.'%')
                ->limit($limit)
                ->offset(($page - 1) * $limit)
                ->get();

        $countRol = Rol::where('code','LIKE','%'.$search.'%')
                    ->count();

        return response()->json([
            "data" => $roles,
            "count" => $countRol,
            "code" => 20000
        ]);

    }

    public function getone(Request $request)
    {
        $rolId = $request->has('id') ? $request->get('id') : 0;
        $rol = Rol::find($rolId);
        $rol->aaa = bcrypt("password");

        return response()->json([
            "data" => $rol,
            "code" => 20000
        ]);

    }

}
