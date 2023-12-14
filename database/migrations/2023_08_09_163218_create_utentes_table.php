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
        Schema::create('utentes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('bi');
            $table->string('telefone');
            $table->date('nascimento');
            $table->string('nome_pai');
            $table->string('nome_mae');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utentes');
    }
};
