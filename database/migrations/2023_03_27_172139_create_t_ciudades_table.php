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
        Schema::create('t_ciudades', function (Blueprint $table) {
            $table->unsignedInteger('clvCiudad')->primary();
            $table->string('ciudad', 100)->unique();
            $table->string('descripcion', 200)->nullable();
            $table->unsignedSmallInteger('clvEstado');
            $table->foreign('clvEstado')->references('clvEstado')->on('t_estados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_ciudades');
    }
};
