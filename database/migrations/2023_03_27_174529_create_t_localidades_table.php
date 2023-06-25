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
            $table->unsignedInteger('clvLocalidad')->primary()->index();
            $table->string('calle');
            $table->smallInteger('noInterior')->nullable();
            $table->smallInteger('noExterior');
            $table->string('colonia');
            $table->text('descripcion')->nullable();
            $table->unsignedInteger('clvCiudad')->index();
            $table->timestamps();

            $table->foreign('clvCiudad')->references('clvCiudad')->on('t_ciudades')->onDelete('cascade');
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