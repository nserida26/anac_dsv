<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latrine extends Model
{
    use HasFactory;
    protected $fillable = ['type_bloc','nbr_bloc','etat_bloc','infrastructure_id'];
    public $timestamps = false;
}
