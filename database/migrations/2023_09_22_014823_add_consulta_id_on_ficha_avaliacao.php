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
        Schema::table('ficha_avaliacaos', function (Blueprint $table) {
            $table->foreignId('consulta_id')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ficha_avaliacaos', function (Blueprint $table) {
            $table->dropColumn('consulta_id');
        });
    }
};
