<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColaboradorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colaboradores', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('codigo_empleado');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('fotografia')->default('/img/profile-default.jpg');
            $table->string('dpi')->nullable();
            $table->string('fecha_nacimiento');
            $table->string('direccion')->nullable();
            $table->string('ps');
            $table->string('telefono');
            $table->string('telefono_emergencia')->nullable();
            $table->string('email');
            $table->string('profesion')->nullable();
            $table->string('estudios')->nullable();
            $table->string('universidad')->nullable();
            $table->string('ultimo_anio_universidad')->nullable();
            $table->string('cargo')->nullable();
            $table->string('fecha_alta')->nullable();
            $table->string('estado')->default('activo');
            $table->foreignId('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('colaboradores');
    }
}
