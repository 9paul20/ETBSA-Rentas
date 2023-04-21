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
        Schema::create('t_personas', function (Blueprint $table) {
            $table->bigIncrements('clvPersona');
            $table->string('nombrePersona')->nullable();
            $table->string('apePaternoPersona')->nullable();
            $table->string('apeMaternoPersona')->nullable();
            $table->date('nacimiento')->nullable();
            $table->unsignedInteger('clvLocalidad')->nullable();
            $table->string('telefono')->unique()->nullable();
            $table->string('celular')->unique()->nullable();
            $table->unsignedTinyInteger('clvComTel')->nullable();
            $table->string('ocupacion')->nullable();
            $table->unsignedTinyInteger('clvNacionalidad')->nullable();
            $table->string('informacion')->nullable();
            $table->timestamps();

            $table->index('clvPersona');
            $table->index('clvLocalidad');
            $table->index('clvComTel');
            $table->index('clvNacionalidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_personas');
    }
};
