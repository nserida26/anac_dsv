<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hygiene extends Model
{
    use HasFactory;
    protected $fillable = ['type','effectif','description','intervenant_id','projet_id'];
    public $timestamps = false;
}
