<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfils', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('descricao');
            $table->timestamps();
        });

        Schema::create('perfil_permissao', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("perfil_id");
            $table->unsignedBigInteger("permissao_id");

            $table->foreign('perfil_id')
                    ->references('id')->on('perfils')
                    ->onDelete('cascade');
            $table->foreign('permissao_id')
                    ->references('id')->on('permissaos')
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
        Schema::dropIfExists('perfil_permissao');
        Schema::dropIfExists('perfils');
    }
}
