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
        Schema::create('t_tipos_gastos_fijos', function (Blueprint $table) {
            $table->tinyIncrements('clvTipoGastoFijo');
            $table->string('tipoGastoFijo')->unique();
            $table->boolean('opcionUnica');
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->index('clvTipoGastoFijo');
            $table->index('tipoGastoFijo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_tipos_gastos_fijos');
    }
};