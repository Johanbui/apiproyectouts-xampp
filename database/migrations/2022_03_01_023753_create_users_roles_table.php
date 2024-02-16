<?php

use App\Models\Rol;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUsersRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('rol_id')->default(1);
            $table->foreign('rol_id')->references('id')->on('roles');
        });


        $rol = new Rol();
        $rol->code = "SUPERADMINISTRADOR";
        $rol->name = "Super Administrador";
        $rol->enable = TRUE;
        $rol->save();

        $user = new User();
        $user->name = "Unidades Tecnologicas";
        $user->last_name = "De Santander";
        $user->email = "superuts@uts.edu.co";
        $user->avatar = "https://avatars.githubusercontent.com/u/15214301?v=4";
        $user->gender = 1;
        $user->enable = 1;
        $user->password = Hash::make("Uts2024");
        $user->save();


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('roles');
    }
}
