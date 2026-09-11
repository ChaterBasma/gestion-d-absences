<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use App\Models\Formateur;
use App\Models\Groupe;
use App\Models\Module;
use Illuminate\Http\Request;

class AffectationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $affectations = Affectation::with('formateur', 'groupe', 'module')->paginate(15);
        return view('affectations.index', compact('affectations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formateurs = Formateur::all();
        $groupes = Groupe::all();
        $modules = Module::all();
        return view('affectations.create', compact('formateurs', 'groupes', 'modules'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Matricule' => 'required|string|exists:formateurs,Matricule',
            'CodeG' => 'required|string|exists:groupes,CodeG',
            'CodeM' => 'required|string|exists:modules,CodeM',
            'MHRealiseP' => 'required|numeric|min:0',
            'MHRealiseD' => 'required|numeric|min:0',
        ]);

        Affectation::create($validated);
        return redirect()->route('affectations.index')->with('success', 'Affectation créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $matricule = $request->route('affectation');
        $affectation = Affectation::where('Matricule', $matricule)->first();
        if (!$affectation) abort(404);
        
        $affectation->load('formateur', 'groupe', 'module');
        return view('affectations.show', compact('affectation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $matricule = $request->route('affectation');
        $affectation = Affectation::where('Matricule', $matricule)->first();
        if (!$affectation) abort(404);
        
        $formateurs = Formateur::all();
        $groupes = Groupe::all();
        $modules = Module::all();
        return view('affectations.edit', compact('affectation', 'formateurs', 'groupes', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $matricule = $request->route('affectation');
        $affectation = Affectation::where('Matricule', $matricule)->first();
        if (!$affectation) abort(404);

        $validated = $request->validate([
            'MHRealiseP' => 'required|numeric|min:0',
            'MHRealiseD' => 'required|numeric|min:0',
        ]);

        $affectation->update($validated);
        return redirect()->route('affectations.index')->with('success', 'Affectation mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $matricule = $request->route('affectation');
        $affectation = Affectation::where('Matricule', $matricule)->first();
        if (!$affectation) abort(404);

        $affectation->delete();
        return redirect()->route('affectations.index')->with('success', 'Affectation supprimée avec succès.');
    }
}
