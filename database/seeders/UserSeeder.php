<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'sac@frete.rio.br',
            'password' => Hash::make('123456'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'      => 'Leo Leão',
            'email'     => 'sac.riodejaneiro@frete.rio.br',
            'password'  => Hash::make('123456'),
            'role'      => 'company',
            'whatsapp'  => '21981813106',
            'state'     => 'RJ',
            'city'      => 'Rio de Janeiro',
        ]);

        User::create([
            'name'      => 'Leo Leão',
            'email'     => 'sac.niteroi@frete.rio.br',
            'password'  => Hash::make('123456'),
            'role'      => 'company',
            'whatsapp'  => '21981813106',
            'state'     => 'RJ',
            'city'      => 'Niterói',
        ]);

        User::create([
            'name'      => 'Leo Leão',
            'email'     => 'sac.novaiguacu@frete.rio.br',
            'password'  => Hash::make('123456'),
            'role'      => 'company',
            'whatsapp'  => '21981813106',
            'state'     => 'RJ',
            'city'      => 'Nova Iguaçu',
        ]);
    }
}
