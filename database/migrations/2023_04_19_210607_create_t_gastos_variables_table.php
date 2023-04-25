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
            $table->bigIncrements('clvGastoVariable');
            $table->string('gastoVariable');
            $table->text('descripcion');
            $table->date('fechaGastoVariable');
            $table->decimal('costoGastoVariable', 10, 2)->default(0.00);
            $table->unsignedBigInteger('clvEquipo')->nullable();
            $table->timestamps();

            $table->index('clvGastoVariable');
            $table->index('gastoVariable');
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