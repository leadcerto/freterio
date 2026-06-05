<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Neighborhood extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'city',
        'state',
        'is_active',
        'meta_title',
        'meta_description',
        'location_text',
        'nearby_neighborhoods',
        'main_streets',
        'shortest_routes',
        'access_notes',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Neighborhood $neighborhood) {
            if (empty($neighborhood->slug)) {
                $neighborhood->slug = Str::slug($neighborhood->name);
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
