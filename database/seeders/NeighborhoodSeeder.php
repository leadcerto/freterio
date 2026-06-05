<?php

namespace Database\Seeders;

use App\Models\Neighborhood;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NeighborhoodSeeder extends Seeder
{
    public function run(): void
    {
        $data = json_decode(
            file_get_contents(database_path('data/neighborhoods.json')),
            true
        );

        $userMap = [
            'Rio de Janeiro' => User::where('city', 'Rio de Janeiro')->first(),
            'Niterói'        => User::where('city', 'Niterói')->first(),
            'Nova Iguaçu'    => User::where('city', 'Nova Iguaçu')->first(),
        ];

        foreach ($data as $city => $neighborhoods) {
            $user = $userMap[$city] ?? null;
            if (! $user) {
                continue;
            }

            foreach ($neighborhoods as $name) {
                Neighborhood::firstOrCreate(
                    ['slug' => Str::slug($name)],
                    [
                        'user_id'   => $user->id,
                        'name'      => $name,
                        'city'      => $city,
                        'state'     => 'RJ',
                        'is_active' => true,
                    ]
                );
            }
        }
    }
}
