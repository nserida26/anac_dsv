<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licence extends Model
{
    use HasFactory;

    protected $fillable = [
        'categorie_licence',
        'machine_licence',
        'type_licence',
        'numero_licence',
        'np',
        'date_naissance',
        'adresse',
        'nationalite',
        'photo',
        'signature',
        'date_deliverance',
        'date_mise_a_jour',
        'date_expiration',
        'licence_valide',
        'licence_bloque',
        'signature_dg',
        'signature_dsv',
        'cachet',
        'demande_id',
        'demandeur_id'
    ];

    protected $casts = [
        'date_naissance' => 'date',
        'date_deliverance' => 'date',
        'date_mise_a_jour' => 'date',
        'date_expiration' => 'date',
        'machine_licence' => 'string',
    ];

    public function demande()
    {
        return $this->belongsTo(Demande::class, 'demande_id');
    }
    public function demandeur()
    {
        return $this->belongsTo(Demandeur::class, 'demandeur_id');
    }
}
