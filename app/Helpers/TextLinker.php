<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class TextLinker
{
    /**
     * Transforma nomes de bairros encontrados no texto em links clicáveis.
     * O bairro atual ($currentSlug) nunca é linkado para não gerar link para si mesmo.
     * Nomes mais longos são processados primeiro para evitar match parcial
     * (ex: "Barra da Tijuca" antes de "Barra").
     */
    public static function linkNeighborhoods(
        string $text,
        Collection $neighborhoods,
        string $currentSlug = ''
    ): string {
        if (empty(trim($text))) {
            return $text;
        }

        // Ordena do nome mais longo para o mais curto
        $sorted = $neighborhoods
            ->filter(fn($n) => $n->slug !== $currentSlug)
            ->sortByDesc(fn($n) => mb_strlen($n->name));

        foreach ($sorted as $n) {
            $name    = $n->name;
            $escaped = preg_quote($name, '#');
            $link    = '<a href="/' . $n->slug . '" class="text-blue-600 hover:underline font-medium">' . $name . '</a>';

            // Substitui todas as ocorrências (case-insensitive, unicode)
            // Usa lookahead/lookbehind para não substituir dentro de tags já existentes
            $text = preg_replace(
                '#(?<!["\'/=>])' . $escaped . '(?!["\'/<=a-zA-ZÀ-ÿ])#u',
                $link,
                $text
            );
        }

        return $text;
    }

    /**
     * Converte quebras de linha em <br> e aplica linkificação de bairros.
     */
    public static function formatAndLink(
        string $text,
        Collection $neighborhoods,
        string $currentSlug = ''
    ): string {
        $linked = self::linkNeighborhoods($text, $neighborhoods, $currentSlug);
        return nl2br(e($linked), false);
    }

    /**
     * Versão que preserva HTML já existente (para textos que já têm formatação).
     */
    public static function formatRichAndLink(
        string $text,
        Collection $neighborhoods,
        string $currentSlug = ''
    ): string {
        // Converte markdown simples de listas antes de linkar
        $text = preg_replace('/^[-*]\s+/m', '• ', $text);
        $linked = self::linkNeighborhoods($text, $neighborhoods, $currentSlug);
        return nl2br($linked, false);
    }
}
