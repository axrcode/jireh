<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->integer('id')->unique();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('codigo_mineduc')->nullable();
            $table->string('fecha_nacimiento')->nullable();
            $table->string('fotografia')->default('/img/profile-default.jpg');
            $table->string('ps')->nullable();
            $table->string('genero')->nullable();
            $table->string('lateralidad')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('estudiantes');
    }
}
