<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTamanhoItensPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tamanho_itens_pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_pedido_id');
            $table->unsignedBigInteger('tamanho_produto_id');
            $table->double("valor_unitario", 10,2)->nullable();
            $table->double("quantidade", 10,2)->nullable();
            $table->timestamps();

            $table->foreign('item_pedido_id')->references('id')->on('item_pedidos')->onDelete('cascade');
            $table->foreign('tamanho_produto_id')->references('id')->on('tamanho_produtos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tamanho_itens_pedidos');
    }
}
