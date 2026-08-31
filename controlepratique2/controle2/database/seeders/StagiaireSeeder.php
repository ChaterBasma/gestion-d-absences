<?php

namespace Database\Seeders;

use App\Models\Stagiaire;
use Illuminate\Database\Seeder;

class StagiaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Exemple de stagiaires pour tester
        $stagiaires = [
            ['CodeS' => 'S001', 'Nom' => 'Dupont', 'Prenom' => 'Jean', 'email' => 'jean.dupont@example.com', 'CodeG' => 'DEV101'],
            ['CodeS' => 'S002', 'Nom' => 'Martin', 'Prenom' => 'Marie', 'email' => 'marie.martin@example.com', 'CodeG' => 'DEV101'],
            ['CodeS' => 'S003', 'Nom' => 'Bernard', 'Prenom' => 'Pierre', 'email' => 'pierre.bernard@example.com', 'CodeG' => 'DEV101'],
            ['CodeS' => 'S004', 'Nom' => 'Thomas', 'Prenom' => 'Luc', 'email' => 'luc.thomas@example.com', 'CodeG' => 'DEV102'],
            ['CodeS' => 'S005', 'Nom' => 'Robert', 'Prenom' => 'Anne', 'email' => 'anne.robert@example.com', 'CodeG' => 'DEV102'],
            ['CodeS' => 'S006', 'Nom' => 'Richard', 'Prenom' => 'Sophie', 'email' => 'sophie.richard@example.com', 'CodeG' => 'DEV102'],
            ['CodeS' => 'S007', 'Nom' => 'Petit', 'Prenom' => 'Claude', 'email' => 'claude.petit@example.com', 'CodeG' => 'DEV103'],
            ['CodeS' => 'S008', 'Nom' => 'Durand', 'Prenom' => 'Isabelle', 'email' => 'isabelle.durand@example.com', 'CodeG' => 'DEV103'],
        ];

        foreach ($stagiaires as $stagiaire) {
            Stagiaire::create($stagiaire);
        }
    }
}
