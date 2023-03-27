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
        Schema::create('t_documentos', function (Blueprint $table) {
            $table->bigIncrements('clvDocumento');
            $table->unsignedInteger('clvTipoDocumento');
            $table->unsignedBigInteger('noDocumento')->unique();
            $table->date('fechaExpidicion');
            $table->date('fechaVencimiento');
            $table->string('autoridadEmisora', 200);
            $table->unsignedTinyInteger('clvPais');
            $table->string('imagenEscaneada', 200)->nullable();
            $table->string('descripcion', 200)->nullable();
            $table->foreign('clvTipoDocumento')->references('clvTipoDocumento')->on('t_tipo_documentos');
            $table->foreign('clvPais')->references('clvPais')->on('t_paises');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_documentos');
    }
};
