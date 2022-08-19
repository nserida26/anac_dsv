<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Localite
 *
 * @property $id
 * @property $libele
 * @property $population
 * @property $altitude
 * @property $longitude
 * @property $commune_id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Localite extends Model
{
    
    static $rules = [
		'libele' => 'required',
		'population' => 'required',
		'altitude' => 'required',
		'longitude' => 'required',
		'commune_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['libele','population','altitude','longitude','commune_id'];

    public $timestamps = false;

}
