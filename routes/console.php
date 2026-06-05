<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Atualiza avaliações do Google todo dia às 3h da manhã
Schedule::command('reviews:refresh')->dailyAt('03:00');
