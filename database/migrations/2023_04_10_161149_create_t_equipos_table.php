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
            $table->string('noSerieEquipo')->unique();
            $table->string('noSerieMotor')->unique();
            $table->string('noEconomico')->unique();
            $table->string('modelo');
            $table->unsignedTinyInteger('clvDisponibilidad')->default(0);
            $table->unsignedTinyInteger('clvCategoria')->default(0);
            $table->longText('descripcion')->nullable();
            $table->decimal('precioEquipo', 10, 2)->default(0.00);
            $table->date('fechaAdquisicion');
            $table->timestamps();

            // Agregar índices
            $table->index('noSerieEquipo');
            $table->index('noSerieMotor');
            $table->index('noEconomico');
            $table->index('clvDisponibilidad');
            $table->index('clvCategoria');
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
