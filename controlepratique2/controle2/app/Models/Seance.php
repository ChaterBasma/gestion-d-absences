<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    protected $primaryKey = 'NumS';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['NumS', 'Matricule', 'CodeG', 'CodeM', 'TypeCours', 'Jour', 'HeureD', 'HeureF', 'Duree', 'EffAbsent', 'Valide'];

    protected $casts = [
        'Valide' => 'boolean',
    ];

    /**
     * Get the duration in hours (converted from minutes)
     */
    public function getDureeHeuresAttribute()
    {
        $minutes = $this->attributes['Duree'] ?? 0;
        return round($minutes / 60, 2);
    }

    /**
     * Get the duration in minutes
     */
    public function getDureeMinutesAttribute()
    {
        return $this->attributes['Duree'] ?? 0;
    }

    public function formateur()
    {
        return $this->belongsTo(Formateur::class, 'Matricule', 'Matricule');
    }

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'CodeG', 'CodeG');
    }

    public function module()
    {
        return $this->belongsTo(Module::class, 'CodeM', 'CodeM');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class, 'NumS', 'NumS');
    }

    /**
     * Scope pour filtrer les séances validées
     */
    public function scopeValidees($query)
    {
        return $query->where('Valide', true);
    }

    /**
     * Scope pour filtrer les séances non validées
     */
    public function scopeNonValidees($query)
    {
        return $query->where('Valide', false);
    }
}
