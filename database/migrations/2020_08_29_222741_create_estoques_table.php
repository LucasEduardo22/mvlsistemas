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
            $table->integer('estoque_inicial')->nullable();
            $table->integer('estoque_minimo')->nullable();
            $table->integer('estoque_atual')->nullable();
            $table->integer('estoque_real')->nullable();
            $table->integer('estoque_reservado')->nullable();
            $table->double('preco_venda', 10,2)->nullable();
            $table->double('preco_compra', 10,2)->nullable();
            $table->double('custo_atual', 10,2)->nullable();
            $table->double('custo_producao', 10,2)->nullable();
            $table->enum('tipo_tamano', ["M", "P"])->nullable();
            $table->double('valor_tecido_principal', 10,3)->nullable();
            $table->double('valor_tecido_secundario', 10,3)->nullable();
            $table->double('valor_tecido_terciario', 10,3)->nullable();
            $table->string('cor')->nullable();
            $table->unsignedBigInteger('unidade_id');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
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
