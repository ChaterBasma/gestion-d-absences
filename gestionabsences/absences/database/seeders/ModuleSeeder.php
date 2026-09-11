<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            ['CodeM' => 'M101', 'nom' => 'HTML & CSS', 'MHP' => 40, 'MHD' => 10, 'coef' => '1'],
            ['CodeM' => 'M102', 'nom' => 'JavaScript', 'MHP' => 60, 'MHD' => 20, 'coef' => '2'],
            ['CodeM' => 'M103', 'nom' => 'React', 'MHP' => 80, 'MHD' => 20, 'coef' => '3'],
            ['CodeM' => 'M104', 'nom' => 'PHP', 'MHP' => 100, 'MHD' => 20, 'coef' => '1'],
            ['CodeM' => 'M105', 'nom' => 'Laravel', 'MHP' => 120, 'MHD' => 30, 'coef' => '2'],
            ['CodeM' => 'M106', 'nom' => 'MySQL', 'MHP' => 60, 'MHD' => 15, 'coef' => '3'],
        ];

        foreach ($modules as $module) {
            $MHG = $module['MHP'] + $module['MHD'];
            DB::table('modules')->insert([
                'CodeM' => $module['CodeM'],
                'CodeF' => 'F001',
                'MHP' => $module['MHP'],
                'MHD' => $module['MHD'],
                'MHG' => $MHG,
                'coef' => $module['coef'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
