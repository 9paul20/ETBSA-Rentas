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
        Schema::create('t_rentas', function (Blueprint $table) {
            $table->bigIncrements('clvRenta');
            $table->unsignedBigInteger('clvEquipo')->nullable();
            $table->unsignedBigInteger('clvCliente')->nullable();
            $table->text('descripcion')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->unsignedBigInteger('clvPagoRenta')->nullable();
            $table->unsignedBigInteger('clvEstadoRenta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_rentas');
    }
};
