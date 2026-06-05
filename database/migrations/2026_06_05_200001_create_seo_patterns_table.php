<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_patterns', function (Blueprint $table) {
            $table->id();
            $table->string('rotulo', 100);
            $table->string('title', 100);
            $table->string('description', 200);
            $table->string('og_image', 500)->nullable();
            $table->integer('ordem')->default(0);
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_patterns');
    }
};
