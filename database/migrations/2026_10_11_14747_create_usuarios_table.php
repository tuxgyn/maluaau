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
        Schema::create('usuarios', function (Blueprint $table) {
           $table->id();
           $table->string('nome', 100);
           $table->string('sobrenome', 100);
           $table->string('email', 255)->unique();
           $table->string('telefone', 20);
           $table->string('endereco', 255);
           $table->string('numero', 20);
           $table->string('bairro', 100);
           $table->string('cidade', 100);
           $table->string('estado', 100);
           $table->string('cep', 20);
           $table->string('pet_nome', 100);
           $table->string('pet_raca', 50);
           $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};

