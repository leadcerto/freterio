<?php

namespace App\Services;

use App\Models\GoogleReview;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GooglePlacesService
{
    private string $apiKey;

    private array $profiles;

    public function __construct()
    {
        $this->apiKey = config('services.google_places.key');

        $this->profiles = [
            'Barra da Tijuca' => config('services.google_places.place_id_barra'),
            'Copacabana'      => config('services.google_places.place_id_copacabana'),
            'Taquara'         => config('services.google_places.place_id_taquara'),
        ];
    }

    public function refreshAll(): int
    {
        $total = 0;

        foreach ($this->profiles as $profileName => $placeId) {
            if (empty($placeId)) {
                continue;
            }

            $reviews = $this->fetchReviews($placeId, $profileName);
            $total  += count($reviews);
        }

        return $total;
    }

    private function fetchReviews(string $placeId, string $profileName): array
    {
        try {
            $response = Http::timeout(10)->get(
                'https://maps.googleapis.com/maps/api/place/details/json',
                [
                    'place_id' => $placeId,
                    'fields'   => 'name,rating,reviews',
                    'language' => 'pt-BR',
                    'key'      => $this->apiKey,
                ]
            );

            if (! $response->ok()) {
                Log::warning("Google Places API error for {$profileName}: HTTP {$response->status()}");
                return [];
            }

            $data = $response->json();

            if (($data['status'] ?? '') !== 'OK') {
                Log::warning("Google Places status error for {$profileName}: " . ($data['status'] ?? 'unknown'));
                return [];
            }

            $reviews = $data['result']['reviews'] ?? [];

            // Limpa avaliações antigas deste perfil e reinsere
            GoogleReview::where('place_id', $placeId)->delete();

            foreach ($reviews as $r) {
                if (empty($r['text'])) {
                    continue;
                }

                GoogleReview::create([
                    'place_id'                  => $placeId,
                    'profile_name'              => $profileName,
                    'author_name'               => $r['author_name']               ?? 'Anônimo',
                    'author_url'                => $r['author_url']                ?? null,
                    'profile_photo_url'         => $r['profile_photo_url']         ?? null,
                    'rating'                    => $r['rating']                    ?? 5,
                    'text'                      => $r['text']                      ?? '',
                    'relative_time_description' => $r['relative_time_description'] ?? '',
                    'time'                      => $r['time']                      ?? 0,
                ]);
            }

            return $reviews;

        } catch (\Throwable $e) {
            Log::error("GooglePlacesService error for {$profileName}: " . $e->getMessage());
            return [];
        }
    }
}
