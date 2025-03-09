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
        'objet_licence',
        'type_licence',
        'specialite',
        'status',
        'demandeur_id'
    ];

    public function demandeur()
    {
        return $this->belongsTo(Demandeur::class);
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
        return $this->hasMany(TrainingDemandeur::class);
    }
    public function formations()
    {
        return $this->hasMany(Formation::class, 'demandeur_id');
    }
}
