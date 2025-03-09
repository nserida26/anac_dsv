<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examinateur extends Model
{
    use HasFactory;

    protected $fillable = ['np'];

    public function examens()
    {
        return $this->hasMany(ExamenMedical::class, 'examinateur_id');
    }
    public function centreMedical()
    {
        return $this->belongsTo(CentreMedical::class, 'centre_medical_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}

