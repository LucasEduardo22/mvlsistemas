<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnderecoBairroCidadeEstadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Estados
        Schema::create('estados', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->string('uf', 2);
            $table->timestamps();
        });
        //Cidade
        Schema::create('cidades', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')
                            ->references('id')->on('estados')
                            ->onDelete('cascade');
            $table->timestamps();
        });
        //Bairro
        Schema::create('bairros', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->unsignedBigInteger('cidade_id');
            $table->foreign('cidade_id')
                            ->references('id')->on('cidades')
                            ->onDelete('cascade');
            $table->timestamps();
        });
        //Endereço
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->string('cep', 8);
            $table->unsignedBigInteger('bairro_id');
            $table->foreign('bairro_id')
                            ->references('id')->on('bairros')
                            ->onDelete('cascade');
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
        Schema::dropIfExists('enderecos');
        Schema::dropIfExists('bairros');
        Schema::dropIfExists('cidades');
        Schema::dropIfExists('estados');
    }
}
