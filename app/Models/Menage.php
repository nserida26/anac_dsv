<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Menage
 *
 * @property $id
 * @property $designation
 * @property $nbr
 * @property $localite_id
 * @property $projet_id
 *
 * @property Localite $localite
 * @property Projet $projet
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Menage extends Model
{
    
    static $rules = [
		'designation' => 'required',
		'nbr' => 'required',
		'localite_id' => 'required',
		'projet_id' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['designation','nbr','localite_id','projet_id'];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function localite()
    {
        return $this->hasOne('App\Models\Localite', 'id', 'localite_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function projet()
    {
        return $this->hasOne('App\Models\Projet', 'id', 'projet_id');
    }
    

}
