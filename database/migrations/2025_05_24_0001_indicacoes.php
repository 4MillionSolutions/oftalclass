<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabela de indicacoes principais
        Schema::create('indicacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pessoa_id')->constrained('pessoas')->onDelete('cascade');
            $table->foreignId('indicacao_id')->constrained('pessoas')->onDelete('cascade');
            $table->foreignId('status_indicacao_id')->constrained('status_indicacao')->onDelete('cascade');
            $table->string('link')->nullable();
            $table->string('ativo', 1)->default('A');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicacoes');
    }
};
