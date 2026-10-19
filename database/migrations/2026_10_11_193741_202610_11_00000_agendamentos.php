<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agendamentos', function (Blueprint $table) {
            $table->id();
            $table->string('tutor_name', 100);
            $table->string('phone', 20);
            $table->string('pet_name', 100);
            $table->string('pet_type', 50);
            $table->string('service', 100);
            $table->string('status', 50)->default('pendente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agendamentos');
    }
};