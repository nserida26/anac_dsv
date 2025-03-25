<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class QualificationDemandeur extends Model
{

    use HasFactory;

    protected $fillable = [
        'qualification_id',
        'date_examen',
        'centre_formation_id',
        'demande_id',
        'lieu',
        'document',
        'type_avion_id',
        'type_moteur',
        'type_privilege',
        'machine',
        'amt',
        'rpa',
        'atc',
        'ulm',
        'motif'
    ];

    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }
    function typeAvion()
    {

        return $this->belongsTo(TypeAvion::class);
    }
}
