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
            $table->string('nome', 150);
            $table->string('razao_social', 150);
            $table->string('cpf_cnpj', 18)->unique();
            $table->string('ie', 10)->nullable();
            $table->string('telefone', 10)->nullable();
            $table->string('celular', 11)->nullable();
            $table->string('contato_principal')->nullable();
            $table->string('classificacao', 150)->nullable();
            $table->string('email')->unique();
            $table->string('endereco', 255);
            $table->string('bairro', 50);
            $table->string('cidade', 50);
            $table->string('estado', 50);
            $table->string('cep', 10);
            $table->string('numero');
            $table->string('complemento', 50)->nullable();
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
