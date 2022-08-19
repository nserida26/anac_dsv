<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Intervenant
 *
 * @property $id
 * @property $nom
 * @property $code
 * @property $tel
 * @property $adresse
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Intervenant extends Model
{
    
    static $rules = [
		'nom' => 'required',
		'code' => 'required',
		'tel' => 'required',
		'adresse' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nom','code','tel','adresse'];

    public $timestamps = false;

}
