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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('perfil_acesso')->default(2);
            $table->date('plan_expiration_date')->nullable();
            $table->string('status')->default('A');
            $table->string('documento', 14)->nullable();
            $table->string('chave_pix', 200)->unique()->nullable();;
            $table->string('telefone', 15)->nullable();
            $table->date('data_nascimento')->nullable();
            $table->integer('genero')->nullable();
            $table->string('endereco', 500)->nullable();
            $table->string('numero', 50)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('cidade', 150)->nullable();
            $table->integer('estado')->nullable();
            $table->string('cep', 9)->nullable();
            $table->string('complemento', 100)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'perfil_acesso' => 1,
                'password' => '$2y$10$W8aQ3AC1YCe4lg0bvio1AOQkBK4xRjLyeH0SvxkyqZcFFhjVq9Gxi'
            ],
            [
                'id' => 2,
                'name' => 'Pessoa 2',
                'email' => 'pessoa2@admin.com',
                'perfil_acesso' => 2,
                'password' => '$2y$10$W8aQ3AC1YCe4lg0bvio1AOQkBK4xRjLyeH0SvxkyqZcFFhjVq9Gxi'
            ],
            [
                'id' => 3,
                'name' => 'Pessoa 3',
                'email' => 'pessoa3@admin.com',
                'perfil_acesso' => 2,
                'password' => '$2y$10$W8aQ3AC1YCe4lg0bvio1AOQkBK4xRjLyeH0SvxkyqZcFFhjVq9Gxi'
            ],
            [
                'id' => 4,
                'name' => 'Pessoa 4',
                'email' => 'pessoa4@admin.com',
                'perfil_acesso' => 2,
                'password' => '$2y$10$W8aQ3AC1YCe4lg0bvio1AOQkBK4xRjLyeH0SvxkyqZcFFhjVq9Gxi'
            ]
    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
