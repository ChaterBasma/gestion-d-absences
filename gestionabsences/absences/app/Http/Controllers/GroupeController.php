<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Models\Filiere;
use Illuminate\Http\Request;

class GroupeController extends Controller
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
        $groupes = Groupe::with('filiere')->paginate(15);
        return view('groupes.index', compact('groupes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filieres = Filiere::all();
        return view('groupes.create', compact('filieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'CodeG' => 'required|string|unique:groupes',
            'CodeF' => 'required|string|exists:filieres,CodeF',
            'Libelle' => 'required|string',
        ]);

        Groupe::create($validated);
        return redirect()->route('groupes.index')->with('success', 'Groupe créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Groupe $groupe)
    {
        $groupe->load('filiere');
        return view('groupes.show', compact('groupe'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Groupe $groupe)
    {
        $filieres = Filiere::all();
        return view('groupes.edit', compact('groupe', 'filieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Groupe $groupe)
    {
        $validated = $request->validate([
            'CodeF' => 'required|string|exists:filieres,CodeF',
            'Libelle' => 'required|string',
        ]);

        $groupe->update($validated);
        return redirect()->route('groupes.index')->with('success', 'Groupe mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Groupe $groupe)
    {
        $groupe->delete();
        return redirect()->route('groupes.index')->with('success', 'Groupe supprimé avec succès.');
    }
}
