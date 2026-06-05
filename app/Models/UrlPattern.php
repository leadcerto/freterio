<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrlPattern extends Model
{
    protected $fillable = ['prefix', 'suffix', 'label', 'is_active', 'order', 'seo_pattern_id'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function seoPattern()
    {
        return $this->belongsTo(SeoPattern::class);
    }

    /**
     * Gera o slug completo para um determinado slug de bairro.
     * Ex: prefix="frete-barato", suffix="rio-de-janeiro-rj", bairro="copacabana"
     *     → "frete-barato-copacabana-rio-de-janeiro-rj"
     */
    public function buildSlug(string $neighborhoodSlug): string
    {
        $parts = array_filter([$this->prefix, $neighborhoodSlug, $this->suffix], fn($p) => $p !== '');
        return implode('-', $parts);
    }

    /**
     * Gera a URL pública completa.
     */
    public function buildUrl(string $neighborhoodSlug): string
    {
        return '/' . $this->buildSlug($neighborhoodSlug);
    }

    public function toTemplate(): string
    {
        $parts = array_filter([$this->prefix, '{bairro}', $this->suffix], fn($p) => $p !== '');
        return implode('-', $parts);
    }
}
