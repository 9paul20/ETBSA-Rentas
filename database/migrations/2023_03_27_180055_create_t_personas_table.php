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
            $table->string('nombrePersona');
            $table->string('apePaternoPersona');
            $table->string('apeMaternoPersona');
            $table->date('nacimiento');
            $table->string('email')->unique();
            $table->unsignedInteger('clvLocalidad');
            $table->string('telefono')->unique();
            $table->string('celular')->unique();
            $table->unsignedTinyInteger('clvComTel');
            $table->string('ocupacion');
            $table->unsignedTinyInteger('clvNacionalidad');
            $table->string('informacion')->nullable();
            $table->timestamps();
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
