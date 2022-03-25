<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolPermissionController extends Controller
{
    public function __construct()
    {
    }

    public function update(Request $request)
    {

        $rol_id = $request->has('rol_id') ? $request->get('rol_id') : 1;
        $permissions = $request->has('permissions') ? $request->get('permissions') : [];

        $permissionRol = Rol::find($rol_id)->permission->pluck('id');
        DB::update('update roles_permissions  set enable = 0 where rol_id = '.$rol_id);


        for ($i=0; $i < count($permissions); $i++) {
            $bool = false;

            for ($j=0; $j < count( $permissionRol); $j++) {
                if($permissions[$i] ==  $permissionRol[$j]){
                    $bool = true;
                }
            }

            if(!$bool){
                DB::insert('INSERT INTO roles_permissions (rol_id,permission_id,enable)
                            VALUES ('.$rol_id.','.$permissions[$i].',1)');
            }else{
                DB::update('UPDATE  roles_permissions
                            SET     enable = 1
                            WHERE   rol_id = '.$rol_id.'
                            AND     permission_id = '.$permissions[$i]);
            }
        }


        return response()->json([
            "code" => 20000,
            "rol_id"=>$rol_id
        ]);

    }



}
