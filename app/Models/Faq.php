<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    public function resolveForNeighborhood(string $neighborhoodName): static
    {
        $clone = clone $this;
        $clone->question = str_replace('{bairro}', $neighborhoodName, $this->question);
        $clone->answer = str_replace('{bairro}', $neighborhoodName, $this->answer);
        return $clone;
    }
}
