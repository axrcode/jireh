<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAcademicoCicloinscripcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('academico', function (Blueprint $table) {
            $table->unsignedBigInteger('cicloinscripciones_id')->nullable();
            $table->foreign('cicloinscripciones_id')->references('id')->on('cicloescolar');
            //$table->foreignId('cicloinscripciones_id')->references('id')->on('cicloescolar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('academico', function (Blueprint $table) {
            $table->dropForeign(['cicloinscripciones_id']);
        });
    }
}
