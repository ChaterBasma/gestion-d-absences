<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    protected $primaryKey = 'CodeS';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['CodeS', 'Nom', 'Prenom', 'email', 'CodeG'];

    public function groupe()
    {
        return $this->belongsTo(Groupe::class, 'CodeG', 'CodeG');
    }

    public function absences()
    {
        return $this->hasMany(Absence::class, 'CodeS', 'CodeS');
    }

    /**
     * Get the full name of the stagiaire
     */
    public function getFullNameAttribute()
    {
        return "{$this->Prenom} {$this->Nom}";
    }
}
