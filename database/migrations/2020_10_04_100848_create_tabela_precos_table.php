<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelaPrecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabela_precos', function (Blueprint $table) {
            $table->id();
            $table->string("nome", 50)->unique();
            $table->double("ganho", 10,2)->nullable();
            $table->string("descricao", 150)->nullable();
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
        Schema::dropIfExists('tabela_precos');
    }
}
