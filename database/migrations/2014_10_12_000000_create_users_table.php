<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perfil_id');
            $table->string('nome');
            $table->string('cpf', 11)->unique();
            $table->string('rg', 11)->unique();
            $table->string('celular', 11)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('estado', 50);
            $table->string('cidade', 50);
            $table->string('bairro', 50);
            $table->string('endereco', 255);
            $table->string('cep', 8);
            $table->string('numero');
            $table->string('complemento', 50)->nullable();
            $table->integer('status_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->string('image')->nullable();
            $table->timestamps();
           
            $table->foreign('perfil_id')
                    ->references('id')->on('perfils')
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
        Schema::dropIfExists('users');
    }
}
