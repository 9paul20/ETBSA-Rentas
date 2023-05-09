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
        Schema::create('t_equipos', function (Blueprint $table) {
            $table->bigIncrements('clvEquipo')->index();
            $table->string('noSerieEquipo')->unique()->index();
            $table->string('noSerieMotor')->unique()->index();
            $table->string('noEconomico')->unique()->index();
            $table->string('modelo')->index();
            $table->unsignedTinyInteger('clvDisponibilidad')->default(0)->index();
            $table->unsignedTinyInteger('clvCategoria')->default(0)->index();
            $table->longText('descripcion')->nullable();
            $table->decimal('precioEquipo', 10, 2)->default(0.00);
            $table->string('folioEquipo')->unique()->index();
            $table->date('fechaAdquisicion');
            $table->date('fechaGarantiaExtendida');
            $table->decimal('porDeprAnual', 10, 2)->default(25.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_equipos');
    }
};
