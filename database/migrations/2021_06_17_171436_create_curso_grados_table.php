<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoGradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Schema::create('curso_grado', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')->references('id')->on('cursos');
            $table->foreignId('grado_id')->references('id')->on('grados');
            $table->foreignId('cicloescolar_id')->references('id')->on('cicloescolar');
            $table->timestamps();
        }); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curso_grado');
    }
}
