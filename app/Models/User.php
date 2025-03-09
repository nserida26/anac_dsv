<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /** 
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'photo',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization. 
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function demandeur()
    {
        return $this->hasOne(Demandeur::class, 'user_id');
    }

    public function examinateur()
    {
        return $this->hasOne(Examinateur::class, 'user_id');
    }
    public function signature()
    {
        return $this->hasOne(Signature::class, 'user_id');
    }
    public function cachet()
    {
        return $this->hasOne(Cachet::class, 'user_id');
    }

    public function compagnie()
    {
        return $this->hasOne(Compagnie::class, 'user_id');
    }
    public function centreFormation()
    {
        return $this->hasOne(CentreFormation::class, 'user_id');
    }
}
