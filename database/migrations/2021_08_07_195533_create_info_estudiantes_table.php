<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->boolean('conexion_internet');
            $table->string('conexion_tipo')->nullable();
            $table->string('conexion_velocidad')->nullable();
            $table->boolean('equipo_tecnologico');
            $table->string('equipo_tipo')->nullable();
            $table->integer('estudiante_id');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
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
        Schema::dropIfExists('info_estudiantes');
    }
}
