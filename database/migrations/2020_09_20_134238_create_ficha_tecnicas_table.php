<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichaTecnicasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_tecnicas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aviamento_id');
            $table->unsignedBigInteger('produto_id');
            $table->string("detalhes", 255)->nullable();
            $table->string("observacao", 255)->nullable();
            $table->timestamps();

            $table->foreign('aviamento_id')->references('id')->on('aviamentos')->onDelete('cascade');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ficha_tecnicas');
    }
}
