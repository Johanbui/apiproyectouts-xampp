<?php

use App\Models\Rol;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateIdeasEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ideas_estados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_idea');
            $table->unsignedBigInteger('id_codigo_estado');
            $table->unsignedBigInteger('comentario');
            $table->unsignedBigInteger('id_acta');
            $table->foreign('id_idea')->references('id')->on('ideas')->onDelete('cascade');
            $table->foreign('id_codigo_estado')->references('id')->on('listas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('actas');
    }
}
