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
            $table->string("modelo", 50)->unique();
            $table->string("nome_produto", 150)->unique();
            $table->unsignedBigInteger('sub_grupo_id');
            $table->unsignedBigInteger('status_id');
            $table->string("descricao", 150)->nullable();
            $table->string("image", 150)->nullable();
            $table->timestamps();

            $table->foreign('sub_grupo_id')->references('id')->on('sub_grupos')->onDelete('cascade');
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
        Schema::dropIfExists('produtos');
    }
}
