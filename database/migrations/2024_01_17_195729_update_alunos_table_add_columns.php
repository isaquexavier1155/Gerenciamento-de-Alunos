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
            if (!Schema::hasColumn('alunos', 'email')) {
                $table->string('email')->nullable();
            }

            if (!Schema::hasColumn('alunos', 'telefone')) {
                $table->string('telefone')->nullable();
            }

            if (!Schema::hasColumn('alunos', 'cidade')) {
                $table->string('cidade')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
