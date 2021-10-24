<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_docente', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')->references('id')->on('cursos');
            $table->integer('docente_id');
            $table->foreign('docente_id')->references('id')->on('colaboradores');
            //$table->foreignId('cicloescolar_id')->references('id')->on('cicloescolar');
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
        Schema::dropIfExists('curso_docente');
    }
}
