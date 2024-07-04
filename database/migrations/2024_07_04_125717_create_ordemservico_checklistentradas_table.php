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
        Schema::create('ordemservico_checklistentradas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ordemservico_id');
            $table->unsignedBigInteger('checklistentrada_id');

            $table->foreign('ordemservico_id')
                        ->references('id')
                        ->on('ordemservicos')
                        ->onDelete('cascade');

            $table->foreign('checklistentrada_id')
                        ->references('id')
                        ->on('checklist_entradas')
                        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordemservico_checklistentradas');
    }
};
