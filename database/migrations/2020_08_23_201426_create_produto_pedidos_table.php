<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutoPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produto_pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('produto_id');
            $table->double('valor_unitario', 10,2);
            $table->double('valor_total', 10,2);
            $table->integer('quantidade');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes')
                    ->onDelete('cascade');
            $table->foreign('produto_id')->references('id')->on('produtos')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produto_pedidos');
    }
}
