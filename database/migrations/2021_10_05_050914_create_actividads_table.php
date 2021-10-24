<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->string('punteo')->nullable();
            $table->date('fecha_apertura')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->date('fecha_cierre')->nullable();
            $table->boolean('destacado')->nullable();
            $table->unsignedBigInteger('curso_id')->nullable();
            $table->foreign('curso_id')->references('id')->on('curso_docente');
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
        Schema::dropIfExists('actividades');
    }
}
