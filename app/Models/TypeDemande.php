<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDemande extends Model
{
    use HasFactory;


    protected $table = 'type_demandes';

    protected $fillable = ['nom_fr', 'nom_en'];

    public function demandes()
    {
        return $this->hasMany(Demande::class, 'type_demande_id');
    }
}
