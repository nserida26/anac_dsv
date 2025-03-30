<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'date',
        'description',
        'signature',
        'nom_responsable',
        'type_demande_id',
        'type_licence_id',
        'status',
        'demandeur_id',
        'checklist_admin',
        'checklist_sla',
        'checklist_sma',
        'evaluateur_id'
    ];

    public function demandeur()
    {
        return $this->belongsTo(Demandeur::class, 'demandeur_id');
    }

    public function etatDemande()
    {
        return $this->hasOne(EtatDemande::class, 'demande_id');
    }

    public function licence()
    {
        return $this->hasOne(Licence::class, 'demande_id');
    }

    public function paiement()
    {
        return $this->hasOne(Paiement::class, 'demande_id');
    }
    public function ordre()
    {
        return $this->hasOne(OrdreRecette::class, 'demande_id');
    }

    public function facture()
    {
        return $this->hasOne(Facture::class, 'demande_id');
    }

    public function typeDemande()
    {
        return $this->belongsTo(TypeDemande::class, 'type_demande_id');
    }

    public function typeLicence()
    {
        return $this->belongsTo(TypeLicence::class, 'type_licence_id');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }


    public function medicalExaminations()
    {
        return $this->hasMany(MedicalExamination::class, 'demande_id');
    }

    public function experiences()
    {
        return $this->hasMany(ExperienceDemandeur::class);
    }

    public function competences()
    {
        return $this->hasMany(CompetenceDemandeur::class);
    }

    public function qualifications()
    {
        return $this->hasMany(QualificationDemandeur::class, 'demande_id');
    }

    public function trainings()
    {
        return $this->hasMany(TrainingDemandeur::class, 'demande_id');
    }
}
