<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * `paciente` (
     *      `idpaciente`, `nome completo`, `bi`, `nascimento`, `telefone`, `profissao`,
     *      `id_genero`, `idprovincia`, `idmuicipio`, `comuna`, `endereco`
     * )
     */
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo');
            $table->string('bi');
            $table->date('nascimento');
            $table->string('telefone');
            $table->string('profissao');
            $table->foreignId('genero_id')->constrained();
            $table->foreignId('provincia_id')->constrained();
            $table->foreignId('municipio_id')->constrained();
            $table->string('endereco');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
