<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $primaryKey = 'CodeM';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['CodeM', 'CodeF', 'MHG', 'MHP', 'MHD', 'coef'];

    protected $casts = [
        'MHG' => 'integer',
        'MHP' => 'integer',
        'MHD' => 'integer',
    ];

    /**
     * Get the MHG (Masse Horaire Globale) - calculée automatiquement
     */
    public function getMHGAttribute()
    {
        return ($this->attributes['MHP'] ?? 0) + ($this->attributes['MHD'] ?? 0);
    }

    public function filiere()
    {
        return $this->belongsTo(Filiere::class, 'CodeF', 'CodeF');
    }

    public function seances()
    {
        return $this->hasMany(Seance::class, 'CodeM', 'CodeM');
    }

    public function affectations()
    {
        return $this->hasMany(Affectation::class, 'CodeM', 'CodeM');
    }
}
