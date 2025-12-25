<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        
        User::create([
            'name' => 'Ana Krasić',
            'email' => 'ana@eterna.rs',
            'password' => Hash::make('lozinka123'), 
            'role' => 'admin',
        ]);
    }
}
