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
        Schema::create('t_equipos', function (Blueprint $table) {
            $table->bigIncrements('clvEquipo');
            $table->string('noSerie')->unique();
            $table->string('modelo');
            $table->string('clvDisponibilidad')->nullable();
            $table->string('clvCategoria')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_equipos');
    }
};
