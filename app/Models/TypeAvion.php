<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAvion extends Model
{
    use HasFactory;

    protected $fillable = ['code'];

    // Relation avec les qualifications (si applicable)
    public function qualifications()
    {
        return $this->hasMany(QualificationDemandeur::class, 'type_avion_id');
    }
}
