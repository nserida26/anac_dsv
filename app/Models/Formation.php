<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'attestation',
        'demandeur_id',
        'centre_formation_id',
        'type_formation_id',
        'lieu',
        'date_formation'
    ];

    /**
     * Relation avec le Demandeur
     */
    public function demandeur()
    {
        return $this->belongsTo(Demandeur::class, 'demandeur_id');
    }

    /**
     * Relation avec le Centre de Formation
     */
    public function centreFormation()
    {
        return $this->belongsTo(CentreFormation::class, 'centre_formation_id');
    }

    public function typeFormation()
    {
        return $this->belongsTo(TypeFormation::class, 'type_formation_id');
    }
}

