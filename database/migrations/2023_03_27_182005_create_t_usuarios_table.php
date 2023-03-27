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
        Schema::create('t_usuarios', function (Blueprint $table) {
            $table->bigIncrements('clvUsuario');
            $table->unsignedBigInteger('clvPersona');
            $table->unsignedTinyInteger('clvEstadoUsuario');
            $table->string('password', 200);
            $table->string('email', 100)->unique();
            $table->string('foto', 100)->nullable();
            $table->foreign('clvPersona')->references('clvPersona')->on('t_personas');
            $table->foreign('clvEstadoUsuario')->references('clvEstadoUsuario')->on('t_estados_usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_usuarios');
    }
};
