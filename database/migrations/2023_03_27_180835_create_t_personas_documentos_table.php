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
        Schema::create('t_personas_documentos', function (Blueprint $table) {
            $table->unsignedBigInteger('clvPersona')->index();
            $table->unsignedBigInteger('clvDocumento')->index();
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->foreign('clvPersona')->references('clvPersona')->on('t_personas')->onDelete('cascade');
            $table->foreign('clvDocumento')->references('clvDocumento')->on('t_documentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_personas_documentos');
    }
};