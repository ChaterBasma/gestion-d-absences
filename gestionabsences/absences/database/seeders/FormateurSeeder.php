<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $noms = ['Ahmed', 'Fatima', 'Mohammed', 'Leila', 'Hassan', 'Amina', 'Ali', 'Zahra', 'Omar', 'Noor'];
        $prenoms = ['Cheikh', 'Khatib', 'Mansouri', 'Diallo', 'Ba', 'Kane', 'Sow', 'Thiam', 'Sall', 'Dia'];

        for ($i = 1001; $i <= 1010; $i++) {
            DB::table('formateurs')->insert([
                'Matricule' => (string)$i,
                'Nom' => $noms[$i - 1001],
                'Prenom' => $prenoms[$i - 1001],
                'email' => 'formateur' . $i . '@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
