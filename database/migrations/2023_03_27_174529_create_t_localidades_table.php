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
        Schema::create('t_localidades', function (Blueprint $table) {
            $table->unsignedInteger('clvLocalidad')->primary();
            $table->string('calle', 100);
            $table->smallInteger('noInterior')->nullable();
            $table->smallInteger('noExterior');
            $table->string('colonia', 100);
            $table->string('descripcion', 200)->nullable();
            $table->unsignedInteger('clvCiudad');
            $table->foreign('clvCiudad')->references('clvCiudad')->on('t_ciudades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_localidades');
    }
};
