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
        Schema::create('t_nacionalidades', function (Blueprint $table) {
            $table->tinyIncrements('clvNacionalidad');
            $table->string('nacionalidad')->unique();
            $table->text('descripcion')->nullable();
            $table->timestamps();

            $table->index('clvNacionalidad');
            $table->index('nacionalidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_nacionalidades');
    }
};
