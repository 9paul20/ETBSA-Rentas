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
            $table->tinyIncrements('clvPagoRenta');
            $table->decimal('pagoRenta', 10, 2)->nullable();
            $table->decimal('ivaRenta', 10, 2)->nullable();
            $table->unsignedTinyInteger('clvEstadoPagoRenta')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->index('clvPagoRenta');
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
