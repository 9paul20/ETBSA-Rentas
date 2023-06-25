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
        Schema::create('t_gastos_variables', function (Blueprint $table) {
            $table->bigIncrements('clvGastoVariable')->comment('Clave Principal de la tabla Gastos Variables')->index();
            $table->string('gastoVariable')->index();
            $table->text('descripcion')->nullable();
            $table->date('fechaGastoVariable');
            $table->decimal('costoGastoVariable', 10, 2)->default(0.00);
            $table->unsignedBigInteger('clvEquipo')->nullable();
            $table->timestamps();

            $table->foreign('clvEquipo')->references('clvEquipo')->on('t_equipos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_gastos_variables');
    }
};