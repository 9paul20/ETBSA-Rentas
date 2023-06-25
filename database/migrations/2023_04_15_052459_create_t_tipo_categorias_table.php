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
        Schema::create('t_tipo_categorias', function (Blueprint $table) {
            $table->tinyIncrements('clvTipoCategoria')->index();
            $table->string('tipoCategoria')->unique()->index();
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->foreign('clvTipoCategoria')->references('clvTipoCategoria')->on('t_tipo_categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_tipo_categorias');
    }
};