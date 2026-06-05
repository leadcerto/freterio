<?php

namespace App\Http\Controllers;

use App\Helpers\TextLinker;
use App\Models\Faq;
use App\Models\GoogleReview;
use App\Models\Image;
use App\Models\Neighborhood;
use App\Models\UrlPattern;
use Illuminate\Support\Str;

class NeighborhoodController extends Controller
{
    public function show(string $slug)
    {
        $cleanSlug = Str::slug(str_replace('_', '-', $slug));

        if ($cleanSlug !== $slug) {
            return redirect("/{$cleanSlug}", 301);
        }

        [$neighborhood, $pattern] = $this->parseSlug($cleanSlug);

        if (! $neighborhood) {
            abort(404);
        }

        $serviceLabel = $pattern?->label ?? 'Frete';
        $h1           = "{$serviceLabel} em {$neighborhood->name}";

        $seoPattern = $pattern?->seoPattern;
        $ogImage    = null;

        if ($seoPattern && $seoPattern->ativo) {
            $seoVars = [
                'bairro' => $neighborhood->name,
                'slug'   => $neighborhood->slug,
                'cidade' => $neighborhood->city,
                'uf'     => $neighborhood->state ?? 'RJ',
            ];
            $resolved        = $seoPattern->resolve($seoVars);
            $metaTitle       = $resolved['title'];
            $metaDescription = $resolved['description'];
            $ogImage         = $resolved['og_image'];
        } else {
            $metaTitle       = $neighborhood->meta_title ?: "{$h1} | Frete Rio";
            $metaDescription = $neighborhood->meta_description
                ?: "Precisa de {$serviceLabel} em {$neighborhood->name}? Orçamento rápido pelo WhatsApp. Avaliação 5 estrelas no Google. Atendemos toda a região.";
        }

        // Bairros para linkificação (mesma cidade, exceto o atual)
        $allNeighborhoods = Neighborhood::active()
            ->select('name', 'slug')
            ->where('city', $neighborhood->city)
            ->where('id', '!=', $neighborhood->id)
            ->get();

        // Processa os campos de texto: converte nomes de bairros em links
        $neighborhoodTexts = [];
        foreach (['location_text', 'nearby_neighborhoods', 'main_streets', 'shortest_routes', 'access_notes'] as $field) {
            $raw = $neighborhood->$field;
            $neighborhoodTexts[$field] = $raw
                ? TextLinker::formatRichAndLink($raw, $allNeighborhoods, $neighborhood->slug)
                : null;
        }

        $hasNeighborhoodInfo = collect($neighborhoodTexts)->filter()->isNotEmpty();

        $faqs       = Faq::active()->get()->map(fn($faq) => $faq->resolveForNeighborhood($neighborhood->name));
        $reviews    = GoogleReview::highRated()->inRandomOrder()->limit(6)->get();
        $fleetImage = Image::active()->ofType('frota')->first();
        $hasDestaque = Image::active()->ofType('destaque')->exists();
        $hasWhatsappImg = Image::active()->ofType('whatsapp')->exists();
        $whatsapp   = $neighborhood->user->whatsapp ?? '21981813106';
        $waMessage  = urlencode("Olá, gostaria de um orçamento de {$serviceLabel} em {$neighborhood->name}.");

        // Slug da URL atual para a imagem destaque mascarada
        $pageSlug   = $cleanSlug;

        return view('neighborhoods.show', compact(
            'neighborhood', 'serviceLabel', 'h1',
            'metaTitle', 'metaDescription', 'ogImage',
            'faqs', 'neighborhoodTexts', 'hasNeighborhoodInfo',
            'fleetImage', 'hasDestaque', 'hasWhatsappImg', 'pageSlug',
            'whatsapp', 'waMessage', 'reviews'
        ));
    }

    private function loadPatterns()
    {
        return UrlPattern::active()
            ->with('seoPattern')
            ->orderByRaw('LENGTH(prefix) DESC')
            ->orderBy('order')
            ->get();
    }

    private function parseSlug(string $slug): array
    {
        $patterns = $this->loadPatterns();

        foreach ($patterns as $pattern) {
            $prefix = $pattern->prefix;
            $suffix = $pattern->suffix;

            $candidate = $slug;

            if ($prefix !== '') {
                if (str_starts_with($candidate, $prefix . '-')) {
                    $candidate = substr($candidate, strlen($prefix) + 1);
                } else {
                    continue;
                }
            }

            if ($suffix !== '') {
                if (str_ends_with($candidate, '-' . $suffix)) {
                    $candidate = substr($candidate, 0, -strlen($suffix) - 1);
                } else {
                    continue;
                }
            }

            $neighborhood = Neighborhood::active()->where('slug', $candidate)->first();
            if ($neighborhood) {
                return [$neighborhood, $pattern];
            }
        }

        return [null, null];
    }
}
