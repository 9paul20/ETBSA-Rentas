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
        Schema::create('t_disponibilidad', function (Blueprint $table) {
            $table->tinyIncrements('clvDisponibilidad');
            $table->string('disponibilidad')->unique();
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->index('clvDisponibilidad');
            $table->index('disponibilidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_disponibilidad');
    }
};
