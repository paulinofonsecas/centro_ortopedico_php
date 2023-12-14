<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     */
    public function up(): void
    {
        Schema::create('ficha_avaliacaos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained();
            $table->unsignedBigInteger('id_hc');
            $table->text('alergias');
            $table->text('quixas_principais');
            $table->text('app');
            $table->text('apf');
            $table->double('peso');
            $table->text('hda');
            $table->text('estado_geral');
            $table->text('marcha');
            $table->text('forca');
            $table->text('dor');
            $table->text('sensibilidade');
            $table->text('adm');
            $table->text('tonus_muscular');
            $table->boolean('equilibrio_estatico');
            $table->text('indicacao_de_orteses');
            $table->text('diagnostico_clinico');
            $table->text('diagnostico_funcional');
            $table->text('prognostico_reabilitacao');
            $table->text('dependecias_avd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha_avaliacaos');
    }
};
