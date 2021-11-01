<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->integer('correlative')->nullable();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->string('fecha_pedido')->nullable();
            $table->string('fecha_entrega')->nullable();
            $table->string('estado')->default('Solicitado');
            $table->foreignId('empleado_id')->references('id')->on('empleados');
            $table->foreignId('cliente_id')->references('id')->on('clientes');
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
        Schema::dropIfExists('pedidos');
    }
}
