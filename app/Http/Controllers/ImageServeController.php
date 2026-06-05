<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ImageServeController extends Controller
{
    /**
     * Serve a imagem destaque com URL mascarada pelo keyword da página.
     * Ex: /imagens/frete-barato-copacabana.webp → serve o arquivo destaque ativo
     * O Google indexa a imagem com a palavra-chave na URL.
     */
    public function serve(string $keyword): Response
    {
        $image = Image::active()->ofType('destaque')->latest()->first();

        if (! $image || ! Storage::disk('public')->exists($image->path)) {
            abort(404);
        }

        $content = Storage::disk('public')->get($image->path);

        return response($content, 200, [
            'Content-Type'        => 'image/webp',
            'Content-Disposition' => 'inline; filename="' . $keyword . '.webp"',
            'Cache-Control'       => 'public, max-age=2592000', // 30 dias
        ]);
    }

    /**
     * Serve o ícone do botão flutuante do WhatsApp.
     */
    public function whatsapp(): Response
    {
        $image = Image::active()->ofType('whatsapp')->latest()->first();

        if (! $image || ! Storage::disk('public')->exists($image->path)) {
            abort(404);
        }

        $content = Storage::disk('public')->get($image->path);

        return response($content, 200, [
            'Content-Type'  => 'image/webp',
            'Cache-Control' => 'public, max-age=2592000',
        ]);
    }
}
