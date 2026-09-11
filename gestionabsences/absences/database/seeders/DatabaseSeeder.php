<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            FiliereSeeder::class,
            FormateurSeeder::class,
            GroupeSeeder::class,
            ModuleSeeder::class,
        ]);

        // Créer les utilisateurs avec différents rôles
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Ahmed Cheikh',
            'email' => 'ahmed@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('formateur123'),
            'role' => 'F',
            'Matricule' => '1001',
        ]);

        User::factory()->create([
            'name' => 'Fatima Khatib',
            'email' => 'fatima@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('formateur123'),
            'role' => 'F',
            'Matricule' => '1002',
        ]);

        User::factory()->create([
            'name' => 'Direction User',
            'email' => 'direction@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('direction123'),
            'role' => 'D',
        ]);
    }
}
