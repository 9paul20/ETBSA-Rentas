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
        Schema::create('t_estados', function (Blueprint $table) {
            $table->smallIncrements('clvEstado');
            $table->string('estado')->unique();
            $table->text('descripcion')->nullable();
            $table->unsignedTinyInteger('clvPais');
            $table->timestamps();

            $table->index('clvEstado');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_estados');
    }
};
