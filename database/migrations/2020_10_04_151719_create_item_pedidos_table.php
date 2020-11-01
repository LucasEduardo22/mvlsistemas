<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_id');
            $table->unsignedBigInteger('estoque_id');
            $table->double("valor_unitario", 10,2)->nullable();
            $table->double("valor_total", 10,2)->nullable();
            $table->double("quantidade")->nullable();
            $table->string("cor_principal")->nullable();
            $table->string("cor_secundaria")->nullable();
            $table->string("cor_terciaria")->nullable();
            $table->string("frente")->nullable();
            $table->string("costa")->nullable();
            $table->string("manga_direita")->nullable();
            $table->string("manga_esquerda")->nullable();
            $table->enum('tipo_tamano', ["T", "M", "F", "U", "N"]);
            $table->timestamps();

            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
            $table->foreign('estoque_id')->references('id')->on('estoques')->onDelete('cascade');
        });

        Schema::create('item_pedido_tecidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_pedido_id');
            $table->unsignedBigInteger('tecido_id');

            $table->foreign('item_pedido_id')->references('id')->on('item_pedidos')->onDelete('cascade');
            $table->foreign('tecido_id')->references('id')->on('tecidos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_pedido_tecidos');
        Schema::dropIfExists('item_pedidos');
    }
}
