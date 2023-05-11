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
            $table->bigIncrements('clvRenta')->index();
            $table->unsignedBigInteger('clvEquipo')->index();
            $table->unsignedBigInteger('clvCliente')->index();
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('clvEstadoRenta')->index();
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