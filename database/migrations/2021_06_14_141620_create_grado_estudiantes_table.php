<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradoEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grado_estudiante', function (Blueprint $table) {
            $table->id();
            $table->integer('estudiante_id');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->foreignId('grado_id')->references('id')->on('grados');
            $table->foreignId('cicloescolar_id')->references('id')->on('cicloescolar');
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
        Schema::dropIfExists('grado_estudiante');
    }
}
