<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('google_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('place_id');
            $table->string('profile_name');
            $table->string('author_name');
            $table->string('author_url')->nullable();
            $table->string('profile_photo_url')->nullable();
            $table->unsignedTinyInteger('rating');
            $table->text('text')->nullable();
            $table->string('relative_time_description')->nullable();
            $table->unsignedBigInteger('time');
            $table->timestamps();

            $table->index('place_id');
            $table->index('rating');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('google_reviews');
    }
};
