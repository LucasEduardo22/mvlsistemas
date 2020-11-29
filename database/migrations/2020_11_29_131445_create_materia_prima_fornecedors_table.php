<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriaPrimaFornecedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_prima_fornecedors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('materia_prima_id');
            $table->unsignedBigInteger('fornecedor_id');
            $table->double('valor_compra')->nullable();
            $table->string("observacao", 255)->nullable();
            $table->timestamps();

            $table->foreign('materia_prima_id')->references('id')->on('materia_primas')->onDelete('cascade');
            $table->foreign('fornecedor_id')->references('id')->on('fornecedors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materia_prima_fornecedors');
    }
}
