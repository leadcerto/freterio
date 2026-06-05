<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE images MODIFY COLUMN type ENUM(
            'destaque','frota','whatsapp',
            'veiculo_1','veiculo_2','veiculo_3','veiculo_4','veiculo_5'
        ) NOT NULL DEFAULT 'destaque'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE images MODIFY COLUMN type ENUM('destaque','frota','whatsapp') NOT NULL DEFAULT 'destaque'");
    }
};
