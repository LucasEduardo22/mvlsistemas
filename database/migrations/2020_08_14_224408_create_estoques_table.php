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
            //$table->double('quantidade', 10,2);
            $table->integer('estoque_inicial')->nullable();
            $table->integer('estoque_minimo')->nullable();
            $table->integer('estoque_maximo')->nullable();
            $table->integer('estoque_atual')->nullable(); //para venda
            $table->integer('estoque_real')->nullable();//todo estoque
            $table->integer('estoque_resevardo')->nullable();//pendente
            $table->double('preco_venda', 10,2)->nullable();
            $table->double('custo_atual', 10,2)->nullable();
            $table->double('custo_medio', 10,2)->nullable();
            $table->double('custo_producao', 10,2)->nullable();
            $table->string('nf')->nullable();
            $table->timestamps();
            $table->foreign('produto_id')
                ->references('id')->on('produtos')
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
        Schema::dropIfExists('estoques');
    }
}
