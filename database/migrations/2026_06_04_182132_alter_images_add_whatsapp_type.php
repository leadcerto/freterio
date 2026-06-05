<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Substitui os tipos antigos (hero, fleet, team) pelos novos mais claros
        DB::statement("ALTER TABLE images MODIFY COLUMN type ENUM('destaque','frota','whatsapp') NOT NULL DEFAULT 'destaque'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE images MODIFY COLUMN type ENUM('hero','fleet','team') NOT NULL DEFAULT 'hero'");
    }
};
