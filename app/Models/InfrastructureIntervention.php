<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfrastructureIntervention extends Model
{
    use HasFactory;
    protected $fillable = ['infrastructure_id','intervention_id','date_intervention'];
    public $timestamps = false;
}
