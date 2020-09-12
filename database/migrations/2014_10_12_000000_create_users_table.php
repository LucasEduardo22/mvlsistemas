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
            $table->string('name');
            $table->string('cpf', 11)->unique();
            $table->string('email')->unique();
            $table->string('telefone', 11);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('status_id');
            $table->string('endereco', 255);
            $table->string('bairro', 50);
            $table->string('cidade', 50);
            $table->string('estado', 50);
            $table->string('cep', 10);
            $table->string('numero');
            $table->string('complemento', 50);
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('perfil_id')->references('id')->on('perfils')->onDelete('cascade');
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
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
