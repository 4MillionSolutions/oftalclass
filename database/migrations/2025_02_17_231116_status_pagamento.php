<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_indicacao', function (Blueprint $table) {
            $table->id();
            $table->string('nome',100);
            $table->string('status',1)->default('A');
            $table->timestamps();
        });

        DB::table('status_indicacao')->insert(
            [
                ['id' => 1, 'nome' => 'pendente', 'status' => 'A'],
                ['id' => 2, 'nome' => 'Pago', 'status' => 'A'],
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
        Schema::dropIfExists('status_pagamento');
    }
};
