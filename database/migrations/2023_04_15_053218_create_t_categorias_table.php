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
        Schema::create('t_categorias', function (Blueprint $table) {
            $table->tinyIncrements('clvCategoria')->index();
            $table->string('categoria')->unique()->index();
            $table->text('descripcion')->nullable();
            $table->unsignedTinyInteger('clvTipoCategoria')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_categorias');
    }
};