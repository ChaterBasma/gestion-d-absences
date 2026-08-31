<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = ['Matricule', 'CodeG', 'CodeM', 'MHRealiseP', 'MHRealiseD'];

    protected $casts = [
        'MHRealiseP' => 'decimal:2',
        'MHRealiseD' => 'decimal:2',
    ];

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
}
