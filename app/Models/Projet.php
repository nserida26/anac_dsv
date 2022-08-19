<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Projet
 *
 * @property $id
 * @property $designation
 * @property $code
 * @property $date_debut
 * @property $date_fin
 * @property $bayeur_id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Projet extends Model
{
    
    static $rules = [
		'designation' => 'required',
		'code' => 'required',
		'date_debut' => 'required',
		'date_fin' => 'required',
		'bayeur_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['designation','code','date_debut','date_fin','bayeur_id'];
    public $timestamps = false;


}
