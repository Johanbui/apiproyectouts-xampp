<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function getAll(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $limit = $request->has('limit') ? $request->get('limit') : 10;
        $search = $request->has('search') ? $request->get('search') : '';


        $users = User::where('name','LIKE','%'.$search.'%')
                ->orWhere('last_name','LIKE','%'.$search.'%')
                ->limit($limit)
                ->offset(($page - 1) * $limit)
                ->get();

        $countUser = User::where('name','LIKE','%'.$search.'%')
                    ->orWhere('last_name','LIKE','%'.$search.'%')
                    ->count();

        return response()->json([
            "data" => $users,
            "count" => $countUser,
            "code" => 20000
        ]);

    }

    public function getone(Request $request)
    {
        $userId = $request->has('id') ? $request->get('id') : 0;
        $user = User::find($userId);
        $user->aaa = bcrypt("password");

        return response()->json([
            "data" => $user,
            "code" => 20000
        ]);

    }

    public function update(Request $request)
    {


        $userId = $request->has('id') ? $request->get('id') : 0;
        $name = $request->has('name') ? $request->get('name') : 0;
        $last_name = $request->has('last_name') ? $request->get('last_name') : 0;
        $email = $request->has('email') ? $request->get('email') : 0;
        $avatar = $request->has('avatar') ? $request->get('avatar') : 0;
        $gender = $request->has('gender') ? $request->get('gender') : 0;
        $enable = $request->has('enable') ? $request->get('enable') : 0;

        $user = User::find($userId);
        $user->name = $name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->avatar = $avatar;
        $user->gender = $gender;
        $user->enable = $enable;
        $user->save();

        return response()->json([
            "data" => $user,
            "code" => 20000
        ]);

    }

    public function toggleEnable(Request $request){

        $userId = $request->has('id') ? $request->get('id') : 0;
        $enable = $request->has('enable') ? $request->get('enable') : 0;

        $user = User::find($userId);
        $user->enable = $enable;
        $user->save();


        return response()->json([
            "data" => $user,
            "code" => 20000
        ]);

    }


    public function create(Request $request)
    {

        $user = new User;
        $user->name = $request->get('name');
        $user->last_name = $request->get('last_name');
        $user->email = $request->get('email');
        $user->email_verified_at =now();
        $user->remember_token =  Str::random(10);
        $user->avatar = $request->get('avatar');
        $user->enable = $request->get('enable');
        $user->gender = $request->get('gender');
        $user->password = Hash::make($request->get('password'));
        $password = $request->get('password');
        $repassword = $request->get('repassword');

        if($password !== $repassword){
            return response()->json([
                "data" => $user,
                "code" => 20000,
                "message"=> "Password and re-password are not the same",
                "type"=>"warning"
            ]);
        }

        $user->save();

        return response()->json([
            "data" => $user,
            "code" => 20000,
            "message"=> "Created Succefully!",
            "type"=>"success"
        ]);


    }


    public function changePassword(Request $request)
    {

        $userId = $request->has('id') ? $request->get('id') : 0;
        $password = $request->get('password');
        $repassword = $request->get('repassword');
        $newpassword = $request->get('newpassword');

        $user = User::find($userId);

        if($password !== $repassword){
            return response()->json([
                "message"=> "Password and re-password are not the same",
                "data" => $user,
                "code" => 20000,
                "type" => "warning"
            ]);
        }
        $credentials =[
            "email"=>$user->email,
            "password" =>$password
        ];


        if(! auth()->attempt($credentials)){
            return response()->json([
                "message"=> "Not Autenticated",
                "data" => $user,
                "code" => 20000,
                "type" => "warning"
            ]);
        }

        $user = User::find($userId);
        $user->password = Hash::make($newpassword);
        $user->save();

        return response()->json([
            "message"=> "Change Password Succesfully",
            "data" => $user,
            "code" => 20000,
            "type" => "success"
        ]);


    }


}
