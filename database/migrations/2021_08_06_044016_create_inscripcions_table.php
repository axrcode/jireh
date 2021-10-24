<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInscripcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id();
            $table->integer('estudiante_id');
            $table->foreign('estudiante_id')->references('id')->on('estudiantes');
            $table->integer('codinscripcion_id');
            $table->foreign('codinscripcion_id')->references('id')->on('cod_inscripciones');
            $table->string('metodo_pago')->nullable();
            $table->string('no_documento')->nullable();
            $table->string('monto')->nullable();
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
        Schema::dropIfExists('inscripciones');
    }
}
