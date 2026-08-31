<?php

namespace App\Http\Controllers;

use App\Models\Formateur;
use App\Models\Seance;
use App\Models\Affectation;
use App\Http\Requests\ImportCSVRequest;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Seul les administrateurs peuvent importer des fichiers.');
            }
            return $next($request);
        });
    }

    /**
     * Afficher le formulaire d'import
     */
    public function showForm()
    {
        return view('import.form');
    }

    /**
     * Traiter l'import du fichier CSV
     */
    public function import(ImportCSVRequest $request)
    {
        $file = $request->file('file');
        $type = $request->input('type');

        try {
            $handle = fopen($file->getRealPath(), 'r');
            
            if ($handle === false) {
                return back()->with('error', 'Impossible d\'ouvrir le fichier.');
            }

            // Lire la première ligne pour détecter le séparateur
            $firstLine = fgets($handle);
            $delimiter = $this->detectDelimiter($firstLine);
            
            // Revenir au début du fichier
            rewind($handle);
            
            // Lire la première ligne avec le bon séparateur
            fgetcsv($handle, 0, $delimiter);
            
            $imported = 0;
            $errors = [];
            $row = 2;

            if ($type === 'formateurs') {
                $imported = $this->importFormateurs($handle, $errors, $row, $delimiter);
            } elseif ($type === 'seances') {
                $imported = $this->importSeances($handle, $errors, $row, $delimiter);
            } elseif ($type === 'affectations') {
                $imported = $this->importAffectations($handle, $errors, $row, $delimiter);
            }

            fclose($handle);

            if (count($errors) > 0) {
                return back()
                    ->with('warning', "$imported enregistrements importés avec succès")
                    ->with('import_errors', $errors);
            }

            return back()->with('success', "$imported enregistrements importés avec succès!");

        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'import: ' . $e->getMessage());
        }
    }

    /**
     * Détecter le séparateur du fichier (virgule ou point-virgule)
     */
    private function detectDelimiter($line)
    {
        // Compter les virgules et points-virgules
        $commaCount = substr_count($line, ',');
        $semicolonCount = substr_count($line, ';');

        // Retourner le plus courant (ou virgule par défaut)
        return $semicolonCount > $commaCount ? ';' : ',';
    }

    /**
     * Importer les formateurs depuis le CSV
     */
    private function importFormateurs($handle, &$errors, &$row, $delimiter = ',')
    {
        $imported = 0;

        while (($data = fgetcsv($handle, 0, $delimiter)) !== false) {
            try {
                if (empty($data[0])) {
                    $row++;
                    continue;
                }

                $matricule = trim($data[0] ?? '');
                $nom = trim($data[1] ?? '');
                $prenom = trim($data[2] ?? '');
                $email = trim($data[3] ?? '');

                if (empty($matricule) || empty($nom) || empty($prenom) || empty($email)) {
                    $errors[] = "Ligne $row: données incomplètes";
                    $row++;
                    continue;
                }

                // Vérifier si le formateur existe déjà
                if (Formateur::where('Matricule', $matricule)->exists()) {
                    $errors[] = "Ligne $row: Matricule $matricule existe déjà";
                    $row++;
                    continue;
                }

                if (Formateur::where('email', $email)->exists()) {
                    $errors[] = "Ligne $row: Email $email existe déjà";
                    $row++;
                    continue;
                }

                Formateur::create([
                    'Matricule' => $matricule,
                    'Nom' => $nom,
                    'Prenom' => $prenom,
                    'email' => $email,
                ]);

                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Ligne $row: " . $e->getMessage();
            }

            $row++;
        }

        return $imported;
    }

    /**
     * Importer les séances depuis le CSV
     */
    private function importSeances($handle, &$errors, &$row, $delimiter = ',')
    {
        $imported = 0;

        while (($data = fgetcsv($handle, 0, $delimiter)) !== false) {
            try {
                if (empty($data[0])) {
                    $row++;
                    continue;
                }

                $numS = trim($data[0] ?? '');
                $matricule = trim($data[1] ?? '');
                $codeG = trim($data[2] ?? '');
                $codeM = trim($data[3] ?? '');
                $typeCours = trim($data[4] ?? '');
                $jour = trim($data[5] ?? '');
                $heureD = trim($data[6] ?? '');
                $heureF = trim($data[7] ?? '');
                $duree = trim($data[8] ?? '0');
                $effAbsent = trim($data[9] ?? '0');

                if (empty($numS) || empty($matricule) || empty($codeG) || empty($codeM)) {
                    $errors[] = "Ligne $row: données incomplètes";
                    $row++;
                    continue;
                }

                // Vérifier si la séance existe déjà
                if (Seance::where('NumS', $numS)->exists()) {
                    $errors[] = "Ligne $row: NumS $numS existe déjà";
                    $row++;
                    continue;
                }

                // Vérifier les références
                if (!\App\Models\Formateur::where('Matricule', $matricule)->exists()) {
                    $errors[] = "Ligne $row: Matricule $matricule n'existe pas";
                    $row++;
                    continue;
                }

                if (!\App\Models\Groupe::where('CodeG', $codeG)->exists()) {
                    $errors[] = "Ligne $row: Groupe $codeG n'existe pas";
                    $row++;
                    continue;
                }

                if (!\App\Models\Module::where('CodeM', $codeM)->exists()) {
                    $errors[] = "Ligne $row: Module $codeM n'existe pas";
                    $row++;
                    continue;
                }

                Seance::create([
                    'NumS' => $numS,
                    'Matricule' => $matricule,
                    'CodeG' => $codeG,
                    'CodeM' => $codeM,
                    'TypeCours' => $typeCours,
                    'Jour' => $jour,
                    'HeureD' => $heureD,
                    'HeureF' => $heureF,
                    'Duree' => (int)$duree,
                    'EffAbsent' => (int)$effAbsent,
                ]);

                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Ligne $row: " . $e->getMessage();
            }

            $row++;
        }

        return $imported;
    }

    /**
     * Importer les affectations depuis le CSV
     */
    private function importAffectations($handle, &$errors, &$row, $delimiter = ',')
    {
        $imported = 0;

        while (($data = fgetcsv($handle, 0, $delimiter)) !== false) {
            try {
                // Vérifier si la ligne est vide ou ne contient qu'une cellule vide
                if (empty($data) || (count($data) == 1 && empty($data[0]))) {
                    $row++;
                    continue;
                }

                // Assurer que nous avons au moins 3 colonnes
                while (count($data) < 3) {
                    $data[] = '';
                }

                $matricule = trim($data[0] ?? '');
                $codeG = trim($data[1] ?? '');
                $codeM = trim($data[2] ?? '');
                // Les deux dernières colonnes sont optionnelles, par défaut à 0
                $mhRealiseP = !empty(trim($data[3] ?? '')) ? (float)trim($data[3]) : 0;
                $mhRealiseD = !empty(trim($data[4] ?? '')) ? (float)trim($data[4]) : 0;

                if (empty($matricule) || empty($codeG) || empty($codeM)) {
                    $errors[] = "Ligne $row: Matricule, CodeG et CodeM sont obligatoires";
                    $row++;
                    continue;
                }

                // Vérifier si l'affectation existe déjà
                if (Affectation::where('Matricule', $matricule)
                    ->where('CodeG', $codeG)
                    ->where('CodeM', $codeM)
                    ->exists()) {
                    $errors[] = "Ligne $row: Affectation $matricule/$codeG/$codeM existe déjà";
                    $row++;
                    continue;
                }

                // Vérifier les références
                if (!\App\Models\Formateur::where('Matricule', $matricule)->exists()) {
                    $errors[] = "Ligne $row: Matricule $matricule n'existe pas";
                    $row++;
                    continue;
                }

                if (!\App\Models\Groupe::where('CodeG', $codeG)->exists()) {
                    $errors[] = "Ligne $row: Groupe $codeG n'existe pas";
                    $row++;
                    continue;
                }

                if (!\App\Models\Module::where('CodeM', $codeM)->exists()) {
                    $errors[] = "Ligne $row: Module $codeM n'existe pas";
                    $row++;
                    continue;
                }

                Affectation::create([
                    'Matricule' => $matricule,
                    'CodeG' => $codeG,
                    'CodeM' => $codeM,
                    'MHRealiseP' => (float)$mhRealiseP,
                    'MHRealiseD' => (float)$mhRealiseD,
                ]);

                $imported++;
            } catch (\Exception $e) {
                $errors[] = "Ligne $row: " . $e->getMessage();
            }

            $row++;
        }

        return $imported;
    }
}
