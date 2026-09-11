<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeStudentKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
protected $signature = 'exam:make-key {matricule}'; 

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $matricule = $this->argument('matricule');
        
        $key = strtoupper(bin2hex(random_bytes(16)));
        
        $content = "MATRICULE: {$matricule}\nKEY: {$key}\nGENERATED_AT: " . date('Y-m-d H:i:s');
        
        $filePath = base_path('STUDENT_KEY.txt');
        
        file_put_contents($filePath, $content);
        
        $this->info("✓ Fichier STUDENT_KEY.txt créé avec succès!");
        
        return 0;
    }
}
