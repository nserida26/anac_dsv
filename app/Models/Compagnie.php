<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compagnie extends Model
{
    use HasFactory;

    // Définir les colonnes autorisées pour l'insertion
    protected $fillable = [
        'nom_entreprise', 'panier'
    ];

    /**
     * Relation entre l'Employeur et les Demandeurs
     * Un Employeur peut avoir plusieurs Demandeurs (employés)
     */
    public function demandeurs()
    {
        return $this->hasMany(Demandeur::class);
    }

    /**
     * Relation entre l'Employeur et les Demandes
     * Un Employeur peut initier plusieurs Demandes
     */
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}
