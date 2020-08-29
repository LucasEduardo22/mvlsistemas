<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstoquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estoques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('tamanho_id');
            $table->integer('estoque_inicial')->nullable();
            $table->integer('estoque_minimo')->nullable();
            $table->integer('estoque_atual')->nullable();
            $table->integer('estoque_real')->nullable();
            $table->integer('estoque_reservado')->nullable();
            $table->double('preco_venda', 10,2)->nullable();
            $table->double('custo_atual', 10,2)->nullable();
            $table->double('custo_producao', 10,2)->nullable();
            $table->unsignedBigInteger('unidade_id');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
            $table->foreign('tamanho_id')->references('id')->on('tamanhos')->onDelete('cascade');
            $table->foreign('unidade_id')->references('id')->on('unidades')->onDelete('cascade');
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
        Schema::dropIfExists('estoques');
    }
}
