<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleAnunciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_anuncios', function (Blueprint $table) {
            $table->id();
            $table->string('adjunto')->nullable();
            $table->string('texto')->nullable();
            $table->string('tipo')->nullable();
            $table->unsignedBigInteger('anuncio_id')->nullable();
            $table->foreign('anuncio_id')->references('id')->on('anuncios');
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
        Schema::dropIfExists('detalle_anuncios');
    }
}
