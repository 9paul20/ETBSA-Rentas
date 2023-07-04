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
        Schema::create('t_estados', function (Blueprint $table) {
            $table->smallIncrements('clvEstado')->index();
            $table->string('estado')->unique()->index();
            $table->text('descripcion')->nullable();
            $table->unsignedTinyInteger('clvPais')->index();
            $table->timestamps();

            $table->foreign('clvPais')->references('clvPais')->on('t_paises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_estados');
    }
};
