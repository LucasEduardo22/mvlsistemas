<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTamanhoProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tamanho_produtos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('estoque_id')->nullable();
            $table->unsignedBigInteger('tamanho_id');
            $table->double('preco_custo', 10,2)->nullable();
            $table->double('preco_venda', 10,2)->nullable();
            $table->double('quantidade', 10,2)->nullable();
            $table->double('estoque_pendente', 10,2)->nullable();
            $table->double('estoque_real', 10,2)->nullable();
            $table->timestamps();

            $table->foreign('estoque_id')->references('id')->on('estoques')->onDelete('cascade');
            $table->foreign('tamanho_id')->references('id')->on('tamanhos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tamanho_produtos');
    }
}
