<?php

namespace App\Console\Commands;

use App\Services\GooglePlacesService;
use Illuminate\Console\Command;

class RefreshGoogleReviews extends Command
{
    protected $signature   = 'reviews:refresh';
    protected $description = 'Busca e armazena as avaliações do Google Meu Negócio';

    public function handle(GooglePlacesService $service): int
    {
        $this->info('Buscando avaliações do Google...');
        $total = $service->refreshAll();
        $this->info("✓ {$total} avaliação(ões) armazenadas.");
        return 0;
    }
}
