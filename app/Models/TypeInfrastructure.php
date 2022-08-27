<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TypeInfrastructure
 *
 * @property $id
 * @property $type
 *
 * @property Infrastructure[] $infrastructures
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class TypeInfrastructure extends Model
{
    
    static $rules = [
		'type' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['type'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function infrastructures()
    {
        return $this->hasMany('App\Models\Infrastructure', 'type_id', 'id');
    }
    

}
