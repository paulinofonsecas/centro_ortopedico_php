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
        Schema::create('tratamentos', function (Blueprint $table) {
            $table->id();
            $table->integer('hc')->nullable();
            $table->dateTime('data');
            $table->integer('sessoes');
            $table->text('observacoes')->nullable();
            $table->string('ta');
            $table->foreignId('paciente_id')->constrained('pacientes');
            $table->foreignId('medico_id')->constrained('medicos');
            $table->foreignId('tipo_tratamento_id')->constrained('tipo_tratamentos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tratamentos');
    }
};
