<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->string('uf');
            $table->timestamps();
        });
        Schema::create('cidades', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')
                            ->references('id')->on('estados')
                            ->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('bairros', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 50);
            $table->unsignedBigInteger('cidade_id');
            $table->foreign('cidade_id')
                            ->references('id')->on('cidades')
                            ->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('endereco', 255);
            $table->string('cep',8);
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
