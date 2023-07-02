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
            $table->unsignedTinyInteger('clvEstadoRenta')->index()->nullable();
            $table->timestamps();

            $table->foreign('clvEquipo')->references('clvEquipo')->on('t_equipos')->onDelete('cascade');
            $table->foreign('clvCliente')->references('clvPersona')->on('t_personas')->onDelete('cascade');
            $table->foreign('clvEstadoRenta')->references('clvEstadoRenta')->on('t_estados_rentas')->onDelete('cascade');
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