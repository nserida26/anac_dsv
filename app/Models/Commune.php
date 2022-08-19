<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Commune
 *
 * @property $id
 * @property $libele
 * @property $population
 * @property $altitude
 * @property $longitude
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Commune extends Model
{
    
    static $rules = [
		'libele' => 'required',
		'population' => 'required',
		'altitude' => 'required',
		'longitude' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['libele','population','altitude','longitude'];



}
