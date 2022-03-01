<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\UserRol;
use Illuminate\Http\Request;

class RolUserController extends Controller
{


    public function getRolUser(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $search = $request->has('search') ? $request->get('search') : '';
        $user_id = $request->has('userId') ? $request->get('userId') : '';

        $roles = Rol::where('name','LIKE','%'.$search.'%')
                ->orWhere('code','LIKE','%'.$search.'%')
                ->limit($limit)
                ->offset(($page - 1) * $limit)
                ->get();

        $user_roles_obj = [];
        for ($i=0; $i < count($roles); $i++) {

            $userRol = UserRol::where("rol_id", $roles[$i]->id)
                            ->where("user_id", $user_id)->first();
            $activateUserRole = 0;

            if($userRol ){
                if(isset($userRol->enable) && $userRol->enable ){
                    if($roles[$i]->enable){
                        $activateUserRole = 1;
                    }
                }
            }

            $roles[$i]->activate = $activateUserRole;
            array_push($user_roles_obj, $roles[$i]);

        }

        $users_rols = $user_roles_obj;

        $countUser = Rol::where('name','LIKE','%'.$search.'%')
                    ->count();

        return response()->json([
            "data" => $users_rols,
            "count" => $countUser,
            "code" => 20000
        ]);
    }


    public function toggleEnable(Request $request){

        $rolId = $request->has('rolId') ? $request->get('rolId') : 0;
        $userId = $request->has('userId') ? $request->get('userId') : 0;
        $enable = $request->has('enable') ? $request->get('enable') : 0;

        $user = UserRol::where("user_id",$userId)->where("rol_id",$rolId)->first();
        if($user){
            $user->enable = $enable;
            $user->save();
        }else{
           $user = new UserRol;
           $user->user_id = $userId ;
           $user->rol_id = $rolId;
           $user->enable = $enable;
           $user->save();
        }

        return response()->json([
            "data" => $user,
            "code" => 20000
        ]);

    }

}
