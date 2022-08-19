<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Menage
 *
 * @property $id
 * @property $designation
 * @property $nbr
 * @property $projet_id
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Menage extends Model
{
    
    static $rules = [
		'designation' => 'required',
		'nbr' => 'required',
		'projet_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['designation','nbr','projet_id'];

    public $timestamps = false;

}
