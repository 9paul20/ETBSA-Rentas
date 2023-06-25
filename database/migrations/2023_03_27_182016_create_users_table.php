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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('clvPersona')->unique()->nullable()->index();
            $table->string('name')->unique()->index();
            $table->string('email')->unique()->index();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->timestamp('last_login')->nullable();
            $table->timestamp('active')->nullable();
            $table->string('activation_key')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('foto')->nullable();

            $table->foreign('clvPersona')->references('clvPersona')->on('t_personas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};