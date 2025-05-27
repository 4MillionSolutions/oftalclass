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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('status_indicacao_id')->constrained('status_indicacao')->onDelete('cascade');
            $table->float('valor')->default(0);
            $table->string('status', 1)->default('A');
            $table->timestamps();
        });

        DB::table('indicacoes')->insert(
            [
                ['id' => 1, 'user_id' => 1, 'status_indicacao_id' => 1, 'valor' => 10.00, 'status' => 'A'],
                ['id' => 2, 'user_id' => 2, 'status_indicacao_id' => 2, 'valor' => 20.00, 'status' => 'A'],
                ['id' => 3, 'user_id' => 3, 'status_indicacao_id' => 1, 'valor' => 15.00, 'status' => 'A'],
                ['id' => 4, 'user_id' => 1, 'status_indicacao_id' => 2, 'valor' => 30.00, 'status' => 'A'],
            ]
        );

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
