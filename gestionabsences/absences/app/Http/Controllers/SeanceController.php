<?php

namespace App\Http\Controllers;

use App\Models\Seance;
use App\Models\Formateur;
use App\Models\Groupe;
use App\Models\Module;
use App\Models\Absence;
use App\Http\Requests\StoreSeanceRequest;
use App\Http\Requests\UpdateSeanceRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SeanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Seance::class);
        
        // Si formateur, afficher ses propres séances
        if (auth()->user()->role === 'F') {
            $seances = Seance::where('Matricule', auth()->user()->Matricule)
                ->with('formateur', 'groupe', 'module')
                ->paginate(15);
        } else {
            // Admin voit toutes les séances
            if (auth()->user()->role === 'admin') {
                $seances = Seance::with('formateur', 'groupe', 'module')->paginate(15);
            } else {
                // Direction : filtrer par statut de validation
                $filter = $request->query('filter', 'non-validees');
                $query = Seance::with('formateur', 'groupe', 'module');
                
                if ($filter === 'validees') {
                    $query->validees();
                } else {
                    $query->nonValidees();
                }
                
                $seances = $query->paginate(15);
            }
        }
        
        // Passer le filtre à la vue pour la Direction
        $filter = null;
        if (auth()->user()->role === 'D') {
            $filter = $request->query('filter', 'non-validees');
        }

        return view('seances.index', compact('seances', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Seance::class);
        
        $formateurs = Formateur::all();
        $groupes = Groupe::all();
        $modules = Module::all();
        return view('seances.create', compact('formateurs', 'groupes', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSeanceRequest $request)
    {
        // Créer la séance
        $seance = Seance::create($request->validated());
        
        // Sauvegarder les absences si des stagiaires absents sont sélectionnés
        if ($request->has('absences') && is_array($request->absences)) {
            $duree = $request->input('Duree', 0);
            $jour = $request->input('Jour');
            
            foreach ($request->absences as $codeS) {
                Absence::create([
                    'CodeS' => $codeS,
                    'NumS' => $seance->NumS,
                    'Jour' => $jour,
                    'Duree' => $duree
                ]);
            }
        }
        
        return redirect()->route('seances.index')->with('success', 'Séance créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Seance $seance)
    {
        $this->authorize('view', $seance);
        $seance->load('formateur', 'groupe', 'module');
        return view('seances.show', compact('seance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seance $seance)
    {
        $this->authorize('update', $seance);
        
        $formateurs = Formateur::all();
        $groupes = Groupe::all();
        $modules = Module::all();
        return view('seances.edit', compact('seance', 'formateurs', 'groupes', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeanceRequest $request, Seance $seance)
    {
        $this->authorize('update', $seance);
        
        $seance->update($request->validated());
        
        // Supprimer les anciennes absences
        $seance->absences()->delete();
        
        // Sauvegarder les nouvelles absences si des stagiaires absents sont sélectionnés
        if ($request->has('absences') && is_array($request->absences)) {
            $duree = $request->input('Duree', 0);
            $jour = $request->input('Jour');
            
            foreach ($request->absences as $codeS) {
                Absence::create([
                    'CodeS' => $codeS,
                    'NumS' => $seance->NumS,
                    'Jour' => $jour,
                    'Duree' => $duree
                ]);
            }
        }
        
        return redirect()->route('seances.index')->with('success', 'Séance mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seance $seance)
    {
        $this->authorize('delete', $seance);
        
        $seance->delete();
        return redirect()->route('seances.index')->with('success', 'Séance supprimée avec succès.');
    }

    /**
     * Afficher l'avancement d'un formateur par groupe et module
     */
    public function avancement(Formateur $formateur)
    {
        // Formateur ne peut voir que son propre avancement
        if (auth()->user()->role === 'F') {
            $this->authorize('viewAny', Seance::class);
            abort_if(auth()->user()->Matricule !== $formateur->Matricule, 403);
        } else {
            // Admin et Direction peuvent voir l'avancement de tous
            $this->authorize('viewAny', Seance::class);
        }
        
        $groupes = $formateur->seances()->distinct()->pluck('CodeG');
        $modules = $formateur->seances()->distinct()->pluck('CodeM');

        $avancementParGroupe = [];
        foreach ($groupes as $codeG) {
            $seances = $formateur->seances()->where('CodeG', $codeG)->get();
            $totalMinutes = $seances->sum('Duree');
            $avancementParGroupe[$codeG] = [
                'groupe' => Groupe::find($codeG),
                'total_seances' => $seances->count(),
                'total_heures' => round($totalMinutes / 60, 2),
                'total_minutes' => $totalMinutes,
                'seances' => $seances
            ];
        }

        $avancementParModule = [];
        foreach ($modules as $codeM) {
            $seances = $formateur->seances()->where('CodeM', $codeM)->get();
            $totalMinutes = $seances->sum('Duree');
            $avancementParModule[$codeM] = [
                'module' => Module::find($codeM),
                'total_seances' => $seances->count(),
                'total_heures' => round($totalMinutes / 60, 2),
                'total_minutes' => $totalMinutes,
                'seances' => $seances
            ];
        }

        return view('seances.avancement', compact('formateur', 'avancementParGroupe', 'avancementParModule'));
    }

    /**
     * Valider une séance (Direction uniquement)
     */
    public function approveSeance(Seance $seance)
    {
        $this->authorize('validate', $seance);
        
        $seance->update(['Valide' => true]);
        return redirect()->back()->with('success', 'Séance validée avec succès.');
    }
    /**
     * Exporter les séances validées en PDF
     */
    public function exportPdf(Request $request)
    {
        // Vérifier que l'utilisateur est Direction
        abort_if(auth()->user()->role !== 'D', 403, 'Non autorisé');

        // Valider les dates
        $validated = $request->validate([
            'date1' => 'required|date',
            'date2' => 'required|date|after_or_equal:date1',
        ], [
            'date1.required' => 'La date de début est requise',
            'date2.required' => 'La date de fin est requise',
            'date2.after_or_equal' => 'La date de fin doit être après ou égale à la date de début',
        ]);

        // Récupérer les séances validées entre les deux dates
        $seances = Seance::where('Valide', true)
            ->whereBetween('created_at', [$validated['date1'], $validated['date2']])
            ->with('formateur', 'groupe', 'module')
            ->orderBy('created_at', 'desc')
            ->get();

        if ($seances->isEmpty()) {
            return back()->with('error', 'Aucune séance validée trouvée pour cette période');
        }

        // Générer le PDF
        $pdf = Pdf::loadView('pdf.seances', [
            'seances' => $seances,
            'date1' => $validated['date1'],
            'date2' => $validated['date2'],
        ]);

        // Télécharger le PDF
        return $pdf->download('seances_validees_' . now()->format('d-m-Y_H-i-s') . '.pdf');
    }

    /**
     * API: Récupérer les stagiaires d'un groupe
     */
    public function getStagiairesParGroupe(Groupe $groupe)
    {
        return response()->json(
            $groupe->stagiaires()
                ->select('CodeS', 'Prenom', 'Nom', 'email')
                ->orderBy('Nom')
                ->get()
        );
    }
}
