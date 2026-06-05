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
        Schema::create('url_patterns', function (Blueprint $table) {
            $table->id();
            // Parte antes do {bairro} na URL — vazio significa /{bairro} direto
            $table->string('prefix')->default('');
            // Parte depois do {bairro} na URL — vazio significa sem sufixo
            $table->string('suffix')->default('');
            // Rótulo amigável exibido no H1 da página (ex: "Frete Barato")
            $table->string('label');
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('url_patterns');
    }
};
