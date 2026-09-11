<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Filiere;
use Illuminate\Http\Request;

class ModuleController extends Controller
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
        $modules = Module::with('filiere')->paginate(15);
        return view('modules.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filieres = Filiere::all();
        return view('modules.create', compact('filieres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'CodeM' => 'required|string|unique:modules',
            'CodeF' => 'required|string|exists:filieres,CodeF',
            'MHP' => 'required|integer|min:0',
            'MHD' => 'required|integer|min:0',
            'MHG' => 'nullable|integer',
            'coef' => 'required|in:1,2,3',
        ]);

        // Calculer MHG s'il n'est pas fourni
        if (empty($validated['MHG'])) {
            $validated['MHG'] = $validated['MHP'] + $validated['MHD'];
        }

        Module::create($validated);
        return redirect()->route('modules.index')->with('success', 'Module créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Module $module)
    {
        $module->load('filiere');
        return view('modules.show', compact('module'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Module $module)
    {
        $filieres = Filiere::all();
        return view('modules.edit', compact('module', 'filieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'CodeF' => 'required|string|exists:filieres,CodeF',
            'MHP' => 'required|integer|min:0',
            'MHD' => 'required|integer|min:0',
            'MHG' => 'nullable|integer',
            'coef' => 'required|in:1,2,3',
        ]);

        // Calculer MHG s'il n'est pas fourni
        if (empty($validated['MHG'])) {
            $validated['MHG'] = $validated['MHP'] + $validated['MHD'];
        }

        $module->update($validated);
        return redirect()->route('modules.index')->with('success', 'Module mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('modules.index')->with('success', 'Module supprimé avec succès.');
    }
}
