<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    protected $primaryKey = 'CodeF';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['CodeF', 'Libelle'];

    public function groupes()
    {
        return $this->hasMany(Groupe::class, 'CodeF', 'CodeF');
    }

    public function modules()
    {
        return $this->hasMany(Module::class, 'CodeF', 'CodeF');
    }
}
