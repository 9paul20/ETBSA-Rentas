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
        Schema::create('t_pagos_rentas', function (Blueprint $table) {
            $table->tinyIncrements('clvPagoRenta')->index();
            $table->decimal('pagoRenta', 10, 2);
            $table->decimal('ivaRenta', 10, 2);
            $table->unsignedBigInteger('clvRenta')->index();
            $table->unsignedTinyInteger('clvEstadoPagoRenta')->index();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pagos_rentas');
    }
};