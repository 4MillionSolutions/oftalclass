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
            $table->string('codigo_indicacao', 10);
            $table->float('valor')->default(0);
            $table->string('status', 1)->default('A');
            $table->string('observacao')->nullable();
            $table->timestamps();
        });

        DB::table('indicacoes')->insert(
            [
                [ 'user_id' => 1, 'status_indicacao_id' => 2, 'codigo_indicacao' => 1, 'valor' => 10.00, 'status' => 'A', 'created_at' => now(), 'updated_at' => now()],
                [ 'user_id' => 1, 'status_indicacao_id' => 1, 'codigo_indicacao' => 1, 'valor' => 5.00, 'status' => 'A', 'created_at' => now(), 'updated_at' => now()],
                [ 'user_id' => 1, 'status_indicacao_id' => 1, 'codigo_indicacao' => 1, 'valor' => 15.00, 'status' => 'A', 'created_at' => now(), 'updated_at' => now()],
                [ 'user_id' => 2, 'status_indicacao_id' => 2, 'codigo_indicacao' => 2, 'valor' => 20.00, 'status' => 'A', 'created_at' => now(), 'updated_at' => now()],
                [ 'user_id' => 3, 'status_indicacao_id' => 1, 'codigo_indicacao' => 3, 'valor' => 15.00, 'status' => 'A', 'created_at' => now(), 'updated_at' => now()],
                [ 'user_id' => 1, 'status_indicacao_id' => 2, 'codigo_indicacao' => 4, 'valor' => 30.00, 'status' => 'A', 'created_at' => now(), 'updated_at' => now()],
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
