<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdFileConfirmationToIdeasArchivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ideas_archivos', function (Blueprint $table) {
            $table->unsignedBigInteger('id_file_confirmation')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ideas_archivos', function (Blueprint $table) {
            $table->dropColumn('id_file_confirmation');
        });
    }
}
