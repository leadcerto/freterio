<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UrlPattern extends Model
{
    protected $fillable = ['prefix', 'suffix', 'label', 'is_active', 'order'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
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
}
