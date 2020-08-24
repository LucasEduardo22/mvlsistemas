<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cliente_id');
            $table->integer('status_id');
            $table->double('total', 10,2);
            $table->string('origem');
            $table->double('total_frete', 10,2)->nullable();
            $table->double('total_desconto', 10,2)->nullable();
            $table->double('total_despesa', 10,2)->nullable();
            $table->string('observacao')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
            $table->foreign('cliente_id')
                    ->references('id')->on('clientes')
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
        Schema::dropIfExists('pedidos');
    }
}
