<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Rol;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
    }

    public function getAll(Request $request)
    {

        $rol_id = $request->has('rol_id') ? $request->get('rol_id') : 1;
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 9999999999999999999999;
        $search = $request->has('search') ? $request->get('search') : '';


        $permissions = Permission::where('code','LIKE','%'.$search.'%')
                ->where('name','LIKE','%'.$search.'%')
                ->limit($limit)
                ->offset(($page - 1) * $limit)
                ->get();

        $countPermissions = Permission::count();

        $permission = Rol::find($rol_id)->permission;

        return response()->json([
            "data" => $permissions,
            "count" => $countPermissions,
            "permission" => $permission,
            "code" => 20000,
            "rol_id"=>$rol_id
        ]);

    }



}
