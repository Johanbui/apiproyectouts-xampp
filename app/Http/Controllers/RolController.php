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
        $limit = $request->has('limit') ? $request->get('limit') : 99999999999999;
        $search = $request->has('search') ? $request->get('search') : '';


        $roles = Rol::where('code','LIKE','%'.$search.'%')
                ->where('name','LIKE','%'.$search.'%')
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

        return response()->json([
            "data" => $rol,
            "code" => 20000
        ]);

    }

    public function update(Request $request)
    {


        $rolId = $request->has('id') ? $request->get('id') : 0;
        $name = $request->has('name') ? $request->get('name') : 0;
        $code = $request->has('code') ? $request->get('code') : 0;
        $enable = $request->has('enable') ? $request->get('enable') : 0;

        $rol = Rol::find($rolId);
        $rol->name = $name;
        $rol->code = $code;
        $rol->enable = $enable;
        $rol->save();

        return response()->json([
            "data" => $rol,
            "code" => 20000
        ]);

    }

    public function create(Request $request)
    {

        $rol = new Rol;
        $rol->code = $request->get('code');
        $rol->name = $request->get('name');
        $rol->enable = $request->get('enable');
        $rol->save();

        return response()->json([
            "data" => $rol,
            "code" => 20000,
            "message"=> "Created Succefully!",
            "type"=>"success"
        ]);

    }

    public function toggleEnable(Request $request){

        $id = $request->has('id') ? $request->get('id') : 0;
        $enable = $request->has('enable') ? $request->get('enable') : 0;

        $user = Rol::find($id);
        $user->enable = $enable;
        $user->save();


        return response()->json([
            "data" => $user,
            "code" => 20000
        ]);

    }

}
