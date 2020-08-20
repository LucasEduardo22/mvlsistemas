<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome_cliente', 150);
            $table->string('razao_social', 150);
            $table->string('cnpj', 14)->unique();
            $table->string('telefone', 11);
            $table->string('email', 150)->unique();
            $table->string('nome_responsavel', 150);
            $table->string('inscricao_estadual', 14)->unique()->nullable();
            $table->string('classificacao', 150)->nullable();
            $table->string('endereco', 150);
            $table->string('numero');
            $table->string('complemento', 50)->nullable();
            $table->string('cep', 8);
            $table->string('bairro', 50);
            $table->string('cidade', 50);
            $table->string('estado', 50);
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
        Schema::dropIfExists('clientes');
    }
}
