<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demandeur extends Model
{
    use HasFactory;


    protected $fillable = [

        'np',
        'date_naissance',
        'lieu_naissance',
        'adresse',
        'adresse_employeur',
        'signature',
        'photo',
        'user_id',
        'compagnie_id',
        'nationalite',
        'valider_compagnie'
    ];

    public function compagnie()
    {
        return $this->belongsTo(Compagnie::class, 'compagnie_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function examens()
    {
        return $this->hasMany(ExamenMedical::class, 'demandeur_id');
    }


    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
    public function formations()
    {
        return $this->hasMany(Formation::class, 'demandeur_id');
    }
}
