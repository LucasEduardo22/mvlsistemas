<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFornecedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fornecedors', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 250);
            $table->string('razao_social', 250)->nullable();
            $table->string('cnpj_cpf')->unique();
            $table->string('inscricao_estadual',14)->unique()->nullable();
            $table->string('email', 250)->unique();
            $table->string('telefone', 10)->nullable();
            $table->string('celular', 11)->nullable();
            $table->string('estado', 50);
            $table->string('cidade', 50);
            $table->string('bairro', 50);
            $table->string('endereco', 255);
            $table->string('cep', 8);
            $table->string('numero');
            $table->string('complemento', 50);
            $table->timestamps();
        });

        Schema::create('produto_fornecedor', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('fornecedor_id');
            $table->foreign('produto_id')
                    ->references('id')->on('produtos')
                    ->onDelete('cascade');
            $table->foreign('fornecedor_id')
                    ->references('id')->on('fornecedors')
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
        Schema::dropIfExists('produto_fornecedor');
        Schema::dropIfExists('fornecedors');
    }
}
