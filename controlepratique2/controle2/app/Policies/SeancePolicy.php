<?php

namespace App\Policies;

use App\Models\Seance;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SeancePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admin, Formateur et Direction peuvent voir les séances
        return in_array($user->role, ['admin', 'F', 'D']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Seance $seance): bool
    {
        // Admin, le formateur de la séance, ou Direction peuvent voir
        if ($user->role === 'admin' || $user->role === 'D') {
            return true;
        }
        
        // Le formateur ne peut voir que ses propres séances
        return $user->role === 'F' && $seance->Matricule === auth()->user()->Matricule;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Seul un formateur peut créer une séance
        return $user->role === 'F';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Seance $seance): bool
    {
        // Admin peut modifier, ou le formateur de la séance
        if ($user->role === 'admin') {
            return true;
        }
        
        return $user->role === 'F' && $seance->Matricule === auth()->user()->Matricule;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Seance $seance): bool
    {
        // Admin peut supprimer, ou le formateur de la séance
        if ($user->role === 'admin') {
            return true;
        }
        
        return $user->role === 'F' && $seance->Matricule === auth()->user()->Matricule;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Seance $seance): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Seance $seance): bool
    {
        return false;
    }

    /**
     * Determine whether the user can validate a seance.
     */
    public function validate(User $user, Seance $seance): bool
    {
        // Seul la Direction peut valider les séances
        return $user->role === 'D';
    }
}
