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
            $table->string('nombrePersona', 50);
            $table->string('apePaternoPersona', 50);
            $table->string('apeMaternoPersona', 50);
            $table->date('nacimiento');
            $table->string('email', 100)->unique();
            $table->unsignedInteger('clvLocalidad');
            $table->string('telefono', 20)->unique();
            $table->string('celular', 20)->unique();
            $table->unsignedTinyInteger('clvComTel');
            $table->string('ocupacion', 200);
            $table->unsignedTinyInteger('clvNacionalidad');
            $table->string('informacion', 255)->nullable();
            $table->foreign('clvLocalidad')->references('clvLocalidad')->on('t_localidades');
            $table->foreign('clvComTel')->references('clvComTel')->on('t_comTel');
            $table->foreign('clvNacionalidad')->references('clvNacionalidad')->on('t_nacionalidades');
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
