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
        Schema::create('t_gastos_mensuales', function (Blueprint $table) {
            $table->bigIncrements('clvGastoMensual')->comment('Clave principal del Gasto Mensual')->index();
            $table->string('gastoMensual');
            $table->decimal('precioEquipo', 10, 2)->nullable();
            $table->unsignedTinyInteger('indiceValorFijo')->index();
            $table->decimal('porGastoMensual', 5, 2)->nullable();
            $table->decimal('costoMensual', 10, 2);
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('clvEquipo')->comment('Clave foranea del Equipo al Gasto Mensual')->index()->nullable();
            $table->unsignedTinyInteger('clvTipoGastoFijo')->comment('Clave foranea del Tipo Gasto Fijo para el Gasto Mensual')->index()->nullable();
            $table->timestamps();

            $table->foreign('clvEquipo')->references('clvEquipo')->on('t_equipos')->onDelete('cascade');
            $table->foreign('clvTipoGastoFijo')->references('clvTipoGastoFijo')->on('t_tipos_gastos_fijos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_gastos_mensuales');
    }
};