<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome',150)->unique();
            $table->unsignedBigInteger('tamanho_id');
            $table->unsignedBigInteger('unidade_id');
            $table->unsignedBigInteger('tipoproduto_id');
            $table->string('codigo_referencia',15)->nullable();
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')
                            ->references('id')->on('categorias')
                            ->onDelete('cascade');
            $table->foreign('tamanho_id')
                            ->references('id')->on('tamanhos');
            $table->foreign('unidade_id')
                            ->references('id')->on('unidades');
            $table->foreign('tipoproduto_id')
                            ->references('id')->on('tipo_produtos');
            //$table->string('grupo_id',255);
            $table->integer('status_id');
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
        Schema::dropIfExists('produtos');
    }
}
