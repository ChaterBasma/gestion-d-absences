<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $codeGs = ['DEV101', 'DEV102', 'DEV103', 'DEV104', 'DEV105', 'DEV106'];
        $libelleGs = ['Groupe 1 - Frontend', 'Groupe 2 - Backend', 'Groupe 3 - Fullstack', 
                      'Groupe 4 - Frontend', 'Groupe 5 - Backend', 'Groupe 6 - Fullstack'];

        foreach ($codeGs as $index => $codeG) {
            DB::table('groupes')->insert([
                'CodeG' => $codeG,
                'CodeF' => 'F001',
                'Libelle' => $libelleGs[$index],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
