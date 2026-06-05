<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('url_patterns', function (Blueprint $table) {
            $table->foreignId('seo_pattern_id')
                ->nullable()
                ->after('order')
                ->constrained('seo_patterns')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('url_patterns', function (Blueprint $table) {
            $table->dropForeign(['seo_pattern_id']);
            $table->dropColumn('seo_pattern_id');
        });
    }
};
