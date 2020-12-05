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
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('tabela_preco_id')->nullable();
            $table->unsignedBigInteger('forma_pagamento_id')->nullable();
            $table->string("drescricao")->nullable();
            $table->enum('tipo_venda', ["V", "O"]);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->foreign('tabela_preco_id')->references('id')->on('tabela_precos')->onDelete('cascade');
            $table->foreign('forma_pagamento_id')->references('id')->on('forma_pagamentos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
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
