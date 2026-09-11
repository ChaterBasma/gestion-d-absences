<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formateur extends Model
{
    protected $primaryKey = 'Matricule';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['Matricule', 'Nom', 'Prenom', 'email'];

    public function seances()
    {
        return $this->hasMany(Seance::class, 'Matricule', 'Matricule');
    }

    public function affectations()
    {
        return $this->hasMany(Affectation::class, 'Matricule', 'Matricule');
    }
}
