<?php

namespace App\Policies;

use App\Models\Formateur;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FormateurPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admin et Direction peuvent voir tous les formateurs
        return in_array($user->role, ['admin', 'D']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Formateur $formateur): bool
    {
        // Admin et Direction peuvent voir les formateurs
        return in_array($user->role, ['admin', 'D']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Admin et Direction peuvent créer un formateur
        return in_array($user->role, ['admin', 'D']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Formateur $formateur): bool
    {
        // Seul admin peut modifier un formateur
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Formateur $formateur): bool
    {
        // Seul admin peut supprimer un formateur
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Formateur $formateur): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Formateur $formateur): bool
    {
        return false;
    }
}
