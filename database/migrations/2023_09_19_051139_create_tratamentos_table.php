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
            $table->string('ta');
            $table->double('peso');
            $table->foreignId('tipo_tratamento_id')->constrained('tipo_tratamentos');
            $table->foreignId('paciente_id')->constrained('pacientes');
            $table->foreignId('tecnico_id')->constrained('tecnicos');
            $table->text('observacoes')->nullable();
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
