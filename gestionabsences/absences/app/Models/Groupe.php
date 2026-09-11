<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    protected $primaryKey = 'CodeG';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['CodeG', 'CodeF', 'Libelle'];

    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'CodeF', 'CodeF');
    }

    public function seances()
    {
        return $this->hasMany(Seance::class, 'CodeG', 'CodeG');
    }

    public function affectations()
    {
        return $this->hasMany(Affectation::class, 'CodeG', 'CodeG');
    }

    public function stagiaires()
    {
        return $this->hasMany(Stagiaire::class, 'CodeG', 'CodeG');
    }
}
