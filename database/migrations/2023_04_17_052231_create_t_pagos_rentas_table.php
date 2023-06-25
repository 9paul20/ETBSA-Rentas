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
            $table->bigIncrements('clvPagoRenta')->index();
            $table->decimal('pagoRenta', 10, 2);
            $table->decimal('ivaRenta', 10, 2);
            $table->unsignedBigInteger('clvRenta')->index();
            $table->unsignedTinyInteger('clvEstadoPagoRenta')->index();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->foreign('clvRenta')->references('clvRenta')->on('t_rentas')->onDelete('cascade');
            $table->foreign('clvEstadoPagoRenta')->references('clvEstadoPagoRenta')->on('t_estados_pagos_rentas')->onDelete('cascade');
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