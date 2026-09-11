<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\AffectationController;
use App\Http\Controllers\ImportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Routes des profils
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes de ressource
    Route::resource('filieres', FiliereController::class);
    Route::resource('groupes', GroupeController::class);
    Route::resource('modules', ModuleController::class);
    Route::resource('formateurs', FormateurController::class);
    Route::resource('seances', SeanceController::class);
    Route::resource('affectations', AffectationController::class);

    // Route pour valider une séance (Direction uniquement)
    Route::post('seances/{seance}/approve', [SeanceController::class, 'approveSeance'])->name('seances.approve');

    // Route pour exporter les séances en PDF
    Route::post('seances/export/pdf', [SeanceController::class, 'exportPdf'])->name('seances.export-pdf');

    // Route pour l'avancement d'un formateur
    Route::get('formateurs/{formateur}/avancement', [SeanceController::class, 'avancement'])->name('seances.avancement');

    // Routes d'import (Admin uniquement)
    Route::get('import', [ImportController::class, 'showForm'])->name('import.form');
    Route::post('import', [ImportController::class, 'import'])->name('import.process');

    // API route pour charger les stagiaires d'un groupe
    Route::get('/api/groupes/{groupe}/stagiaires', [SeanceController::class, 'getStagiairesParGroupe']);

    Route::get('/preview-formateur-mail', function(){
    $formateur = App\Models\Formateur::first();
    return new App\Mail\FormateurCreated($formateur);
   });

    });

require __DIR__.'/auth.php';
