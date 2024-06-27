<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ordemservicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('veiculo_id');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('user_id');
            $table->datetime('dataentrada');
            $table->datetime('dataprogramada');
            $table->double('kminicial', 10, 0);
            $table->string('combustivel');
            $table->text('observacao');
            $table->timestamps();

            $table->foreign('veiculo_id')
                        ->references('id')
                        ->on('veiculos')
                        ->onDelete('cascade');

            $table->foreign('cliente_id')
                        ->references('id')
                        ->on('clientes')
                        ->onDelete('cascade');

            $table->foreign('user_id')
                        ->references('id')
                        ->on('users')
                        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordemservicos');
    }
};
