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
            $table->tinyIncrements('clvGastoFijo')->index();
            $table->string('gastoFijo')->index();
            $table->decimal('costoGastoFijo', 10, 2)->default(0.00)->nullable();
            $table->text('folioFactura')->nullable();
            $table->date('fechaGastoFijo');
            $table->unsignedTinyInteger('clvTipoGastoFijo')->nullable();
            $table->unsignedBigInteger('clvEquipo')->nullable();
            $table->timestamps();
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