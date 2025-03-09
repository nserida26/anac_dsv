<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingDemandeur extends Model
{
    use HasFactory;

    

    protected $fillable = [
        'type',
        'date',
        'validite',
        'centre_formation_id',
        'demande_id',
        'document'
    ];

    public function demande()
    {
        return $this->belongsTo(Demandeur::class);
    }
}
