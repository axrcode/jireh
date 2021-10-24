<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cicloescolar_id')->references('id')->on('cicloescolar');
            $table->foreignId('unidad_id')->references('id')->on('unidades');
            $table->foreignId('empresa_id')->references('id')->on('empresas');
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
        Schema::dropIfExists('academico');
    }
}
