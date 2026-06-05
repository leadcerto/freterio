<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoogleReview extends Model
{
    protected $fillable = [
        'place_id', 'profile_name', 'author_name', 'author_url',
        'profile_photo_url', 'rating', 'text',
        'relative_time_description', 'time',
    ];

    public function scopeHighRated($query)
    {
        return $query->where('rating', '>=', 4)->whereNotNull('text')->where('text', '!=', '');
    }

    public function stars(): string
    {
        return str_repeat('⭐', $this->rating);
    }
}
