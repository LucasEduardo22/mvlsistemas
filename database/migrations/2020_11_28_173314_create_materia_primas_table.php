<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaPrimasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_primas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_produto_id');
            $table->string("nome", 150)->unique();
            $table->string("sigla", 10)->unique();
            $table->string("composicao", 150)->nullable();
            $table->double('estoque_inicial', 10,2)->nullable();
            $table->double('estoque_minimo', 10,2)->nullable();
            $table->double('estoque_atual', 10,2)->nullable();
            $table->double('estoque_real', 10,2)->nullable();
            $table->double('estoque_reservado', 10,2)->nullable();
            $table->double('preco_venda', 10,2)->nullable();
            $table->double('preco_compra', 10,2)->nullable();
            $table->double('custo_atual', 10,2)->nullable();
            $table->double('custo_producao', 10,2)->nullable();
            $table->double('marge_venda', 10,2)->nullable();
            $table->string("descricao", 150)->nullable();
            $table->unsignedBigInteger('unidade_id')->nullable();
            $table->unsignedBigInteger('core_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();

            $table->foreign('tipo_produto_id')->references('id')->on('tipo_produtos')->onDelete('cascade');
            $table->foreign('unidade_id')->references('id')->on('unidades')->onDelete('cascade');
            $table->foreign('core_id')->references('id')->on('cores')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
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
        Schema::dropIfExists('materia_primas');
    }
}
