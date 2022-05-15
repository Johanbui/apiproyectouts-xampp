<?php

use App\Models\Rol;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateListaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_lista_grupo')->default(null);
            $table->string('nombre');
            $table->string('codigo');
            $table->string('valor');
            $table->boolean('estado');
            $table->unsignedBigInteger('idPadre')->nullable()->default(null);
            // $table->foreign('idListaGrupo')->references('id')->on('lista_grupo');
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
        Schema::dropIfExists('lista');
    }
}
