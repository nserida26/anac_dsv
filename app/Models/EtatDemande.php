<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtatDemande extends Model
{
    use HasFactory;

    protected $fillable = [
        'demandeur_cree_demande',
        'dg_annoter',
        'dsv_annoter',
        'pel_annoter',
        'evaluateur_annoter',
        'evaluateur_valider',
        'sm_valider',
        'sl_valider',
        'pel_valider',
        'dsv_valider',
        'dg_valider',
        'dsv_recette',
        'daf_demande_pay',
        'daf_confirme_pay',
        'demandeur_payer',
        'agent_enroler',
        'pel_valider_enrol',
        'dg_signer',
        'dsv_signer',
        'pel_licence_valider',
        'agent_imprimer',
        'user_id',
        'demande_id',


    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Demande

    public function demande()
    {
        return $this->belongsTo(Demande::class, 'demande_id');
    }
}
