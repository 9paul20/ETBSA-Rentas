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
            $table->tinyIncrements('clvDisponibilidad')->index();
            $table->string('disponibilidad')->unique()->index();
            $table->text('descripcion')->nullable();
            $table->text('textColor')->nullable();
            $table->text('bgColorPrimary')->nullable();
            $table->text('bgColorSecondary')->nullable();
            $table->timestamps();
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