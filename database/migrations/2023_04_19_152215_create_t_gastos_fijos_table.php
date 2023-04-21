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
        Schema::create('t_gastos_fijos', function (Blueprint $table) {
            $table->tinyIncrements('clvGastoFijo');
            $table->string('gastoFijo')->unique();
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->index('clvGastoFijo');
            $table->index('gastoFijo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_gastos_fijos');
    }
};
