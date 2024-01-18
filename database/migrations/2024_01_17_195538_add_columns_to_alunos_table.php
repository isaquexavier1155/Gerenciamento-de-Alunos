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
        Schema::table('alunos', function (Blueprint $table) {
            $table->string('email')->nullable(); // Adiciona a coluna 'email'
            $table->string('telefone')->nullable(); // Adiciona a coluna 'telefone'
            $table->string('cidade')->nullable(); // Adiciona a coluna 'cidade'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alunos', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('telefone');
            $table->dropColumn('cidade');
        });
    }
};
