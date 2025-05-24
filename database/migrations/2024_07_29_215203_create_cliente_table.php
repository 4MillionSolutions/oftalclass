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
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 200);
            $table->string('documento', 14)->unique();
            $table->string('telefone', 15)->nullable();            
            $table->date('data_nascimento')->nullable();
            $table->integer('genero')->nullable();
            $table->string('email', 200)->nullable()->unique();
            $table->string('endereco', 500)->nullable();
            $table->string('numero', 50)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('cidade', 150)->nullable();
            $table->integer('estado')->nullable();
            $table->string('cep', 9)->nullable();
            $table->string('complemento', 100)->nullable();
            $table->enum('status', ['A', 'I'])->default('A');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
};
