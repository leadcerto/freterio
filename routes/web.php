<?php

use App\Http\Controllers\ImageServeController;
use App\Http\Controllers\NeighborhoodController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NeighborhoodController as AdminNeighborhoodController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\UrlPatternController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Página principal — redireciona para o bairro Taquara
Route::get('/', fn() => redirect('/taquara', 301))->name('home');

// Sitemap
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

// Imagem destaque mascarada pelo keyword (SEO de imagens)
// Ex: /imagens/frete-barato-copacabana.webp → serve a imagem destaque ativa
Route::get('/imagens/{keyword}.webp', [ImageServeController::class, 'serve'])
    ->where('keyword', '[a-z0-9\-\_]+')
    ->name('image.serve');

// Ícone do botão flutuante do WhatsApp
Route::get('/imagens/whatsapp-btn.webp', [ImageServeController::class, 'whatsapp'])
    ->name('image.whatsapp');

// Alias para compatibilidade com os controllers do Breeze — redireciona para o painel admin
Route::get('/dashboard', fn() => redirect()->route('admin.dashboard'))
    ->middleware(['auth'])
    ->name('dashboard');

// Painel administrativo
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Bairros
    Route::get('/bairros', [AdminNeighborhoodController::class, 'index'])->name('neighborhoods.index');
    Route::get('/bairros/novo', [AdminNeighborhoodController::class, 'create'])->name('neighborhoods.create');
    Route::post('/bairros', [AdminNeighborhoodController::class, 'store'])->name('neighborhoods.store');
    Route::get('/bairros/{neighborhood}/editar', [AdminNeighborhoodController::class, 'edit'])->name('neighborhoods.edit');
    Route::put('/bairros/{neighborhood}', [AdminNeighborhoodController::class, 'update'])->name('neighborhoods.update');
    Route::patch('/bairros/{neighborhood}/toggle', [AdminNeighborhoodController::class, 'toggle'])->name('neighborhoods.toggle');
    Route::delete('/bairros/{neighborhood}', [AdminNeighborhoodController::class, 'destroy'])->name('neighborhoods.destroy');

    // FAQs
    Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
    Route::get('/faqs/novo', [FaqController::class, 'create'])->name('faqs.create');
    Route::post('/faqs', [FaqController::class, 'store'])->name('faqs.store');
    Route::get('/faqs/{faq}/editar', [FaqController::class, 'edit'])->name('faqs.edit');
    Route::put('/faqs/{faq}', [FaqController::class, 'update'])->name('faqs.update');
    Route::delete('/faqs/{faq}', [FaqController::class, 'destroy'])->name('faqs.destroy');

    // Imagens
    Route::get('/imagens', [ImageController::class, 'index'])->name('images.index');
    Route::post('/imagens', [ImageController::class, 'store'])->name('images.store');
    Route::patch('/imagens/{image}/toggle', [ImageController::class, 'toggle'])->name('images.toggle');
    Route::patch('/imagens/{image}/type', [ImageController::class, 'updateType'])->name('images.updateType');
    Route::delete('/imagens/{image}', [ImageController::class, 'destroy'])->name('images.destroy');

    // Padrões de URL (links SEO)
    Route::get('/links', [UrlPatternController::class, 'index'])->name('url-patterns.index');
    Route::post('/links', [UrlPatternController::class, 'store'])->name('url-patterns.store');
    Route::put('/links/{urlPattern}', [UrlPatternController::class, 'update'])->name('url-patterns.update');
    Route::patch('/links/{urlPattern}/toggle', [UrlPatternController::class, 'toggle'])->name('url-patterns.toggle');
    Route::delete('/links/{urlPattern}', [UrlPatternController::class, 'destroy'])->name('url-patterns.destroy');

    // Perfil (Breeze)
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Rota catch-all — DEVE ser a última rota do arquivo
Route::get('/{slug}', [NeighborhoodController::class, 'show'])
    ->where('slug', '[a-z0-9\-\_]+')
    ->name('neighborhood.show');
