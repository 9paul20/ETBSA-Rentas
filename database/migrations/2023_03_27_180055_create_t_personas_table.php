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
            $table->bigIncrements('clvPersona')->index();
            $table->string('nombrePersona')->nullable();
            $table->string('apePaternoPersona')->nullable();
            $table->string('apeMaternoPersona')->nullable();
            $table->date('nacimiento')->nullable();
            $table->unsignedInteger('clvLocalidad')->nullable()->index();
            $table->string('telefono')->unique()->nullable();
            $table->string('celular')->unique()->nullable();
            $table->unsignedTinyInteger('clvComTel')->nullable()->index();
            $table->string('ocupacion')->nullable();
            $table->unsignedTinyInteger('clvNacionalidad')->nullable()->index();
            $table->string('informacion')->nullable();
            $table->timestamps();

            $table->foreign('clvLocalidad')->references('clvLocalidad')->on('t_localidades')->onDelete('cascade');
            $table->foreign('clvComTel')->references('clvComTel')->on('t_com_tel')->onDelete('cascade');
            $table->foreign('clvNacionalidad')->references('clvNacionalidad')->on('t_nacionalidades')->onDelete('cascade');
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