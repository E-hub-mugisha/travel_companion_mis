<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['traveler','admin'];
        $rwandanNames = [
            'Eric Mugisha', 'Aline Uwase', 'Jean Bosco', 'Divine Ingabire',
            'Patrick Nshimiyimana', 'Grace Mukamana', 'Elie Habimana',
            'Alice Uwera', 'Claude Niyonzima', 'Sandrine Umutoni'
        ];

        foreach ($rwandanNames as $index => $name) {
            User::create([
                'name' => $name,
                'email' => 'user' . ($index + 1) . '@inkindi.rw',
                'password' => Hash::make('password'), // default password
                'role' => $roles[array_rand($roles)],
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
