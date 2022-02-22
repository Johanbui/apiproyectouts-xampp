<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;


class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar');
            $table->string('gender');
            $table->boolean('enable');
            $table->rememberToken();
            $table->timestamps();
        });

        $user = new User();
        $user->name = "Andres";
        $user->last_name = "Nova";
        $user->email = "jahiranova@uts.edu.co";
        $user->avatar = "https://avatars.githubusercontent.com/u/15214301?v=4";
        $user->gender = 1;
        $user->enable = 1;
        $user->password = Hash::make("Uts2022");
        $user->save();


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
