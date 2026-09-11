<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('filieres')->insert([
            [
                'CodeF' => 'F001',
                'Libelle' => 'Développement Web',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'CodeF' => 'F002',
                'Libelle' => 'Développement Mobile',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
