<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $fillable = ['CodeS', 'NumS', 'Jour', 'Duree'];

    public function stagiaire()
    {
        return $this->belongsTo(Stagiaire::class, 'CodeS', 'CodeS');
    }

    public function seance()
    {
        return $this->belongsTo(Seance::class, 'NumS', 'NumS');
    }
}
