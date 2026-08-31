<?php

namespace App\Http\Controllers;

use App\Models\Formateur;
use App\Http\Requests\StoreFormateurRequest;
use App\Http\Requests\UpdateFormateurRequest;
use App\Mail\FormateurCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FormateurController extends Controller
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
        $this->authorize('viewAny', Formateur::class);
        
        $formateurs = Formateur::paginate(15);
        return view('formateurs.index', compact('formateurs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Formateur::class);
        
        return view('formateurs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFormateurRequest $request)
    {
        $formateur = Formateur::create($request->validated());

        // Envoyer l'email de bienvenue
        try {
            Mail::to($formateur->email)->send(new FormateurCreated($formateur));
        } catch (\Exception $e) {
            // Log l'erreur mais continue
            \Log::error('Erreur lors de l\'envoi de l\'email au formateur: ' . $e->getMessage());
        }

        return redirect()->route('formateurs.index')->with('success', 'Formateur créé avec succès. Un email de bienvenue a été envoyé.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Formateur $formateur)
    {
        $this->authorize('view', $formateur);
        
        return view('formateurs.show', compact('formateur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formateur $formateur)
    {
        $this->authorize('update', $formateur);
        
        return view('formateurs.edit', compact('formateur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormateurRequest $request, Formateur $formateur)
    {
        $formateur->update($request->validated());

        return redirect()->route('formateurs.index')->with('success', 'Formateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formateur $formateur)
    {
        $this->authorize('delete', $formateur);
        
        $formateur->delete();
        return redirect()->route('formateurs.index')->with('success', 'Formateur supprimé avec succès.');
    }
}
