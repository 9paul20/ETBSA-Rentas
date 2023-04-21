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
        Schema::create('t_equipos_has_gastos_fijos', function (Blueprint $table) {
            $table->unsignedBigInteger('clvEquipo')->comment('Clave foránea del equipo relacionado con el gasto fijo');
            $table->unsignedTinyInteger('clvGastoFijo')->comment('Clave foránea del gasto fijo relacionado con el equipo');
            $table->decimal('costoGastoFijo', 10, 2)->default(0.00);
            $table->timestamps();

            $table->foreign('clvEquipo')->references('clvEquipo')->on('t_equipos')->onDelete('cascade');
            $table->foreign('clvGastoFijo')->references('clvGastoFijo')->on('t_gastos_fijos')->onDelete('cascade');
            $table->primary(['clvEquipo', 'clvGastoFijo'], 'equipos_has_gastos_fijos_clvEquipo_clvGastoFijo_primary');

            $table->index('clvEquipo');
            $table->index('clvGastoFijo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_equipos_has_gastos_fijos');
    }
};
