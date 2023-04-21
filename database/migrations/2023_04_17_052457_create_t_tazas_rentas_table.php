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
        Schema::create('t_tazas_rentas', function (Blueprint $table) {
            $table->bigIncrements('clvTazaRenta');
            $table->string('tazaRenta')->unique();
            $table->decimal('rentaUnMes', 10, 2)->nullable();
            $table->decimal('rentaDosMeses', 10, 2)->nullable();
            $table->decimal('rentaTresMeses', 10, 2)->nullable();
            $table->decimal('ivaUnMes', 10, 2)->nullable();
            $table->decimal('ivaDosMeses', 10, 2)->nullable();
            $table->decimal('ivaTresMeses', 10, 2)->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->index('clvTazaRenta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_tazas_rentas');
    }
};
