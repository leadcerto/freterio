<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoPattern extends Model
{
    protected $fillable = ['rotulo', 'title', 'description', 'og_image', 'ordem', 'ativo'];

    protected function casts(): array
    {
        return ['ativo' => 'boolean'];
    }

    public function scopeAtivo($query)
    {
        return $query->where('ativo', true);
    }

    public function urlPatterns()
    {
        return $this->hasMany(UrlPattern::class);
    }

    public function resolve(array $vars): array
    {
        $search = array_map(fn($k) => '{' . $k . '}', array_keys($vars));
        $values = array_values($vars);

        return [
            'title'       => str_replace($search, $values, $this->title),
            'description' => str_replace($search, $values, $this->description),
            'og_image'    => $this->og_image,
        ];
    }
}
