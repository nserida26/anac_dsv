<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentreMedical extends Model
{
    use HasFactory;
    public function examinateurs()
    {
        return $this->hasMany(Examinateur::class, 'centre_medical_id');
    }
}
