<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleActividadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_actividades', function (Blueprint $table) {
            $table->id();
            $table->string('adjunto')->nullable();
            $table->string('texto')->nullable();
            $table->string('tipo')->nullable();
            $table->unsignedBigInteger('actividad_id')->nullable();
            $table->foreign('actividad_id')->references('id')->on('actividades');
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
        Schema::dropIfExists('detalle_actividades');
    }
}
