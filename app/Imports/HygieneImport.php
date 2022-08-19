<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Localite;
use App\Models\Projet;
use App\Models\Intervenant;
use App\Models\Commune;
use App\Models\Hygiene;

class HygieneImport implements ToCollection
{
    
    private $localites;
    private $communes;
    private $projets;
    private $intervenants;
    //public $message;
    public function __construct()
    {
        
        $this->localites = Localite::select('id')->get(); 
        $this->projets = Projet::select('*')->get(); 
        $this->intervenants = Intervenant::select('id')->get(); 
        $this->communes = Commune::select('id')->get(); 
        # code...
    }
    
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            # code...
            $localite_id = $this->localites->where('libele',$row['localite'])->first();
            $projet_id = $this->projets->where('code',$row['projet'])->first();
            $commune_id = $this->communes->where('libele',$row['commune'])->first();
            $intervenant_id = $this->intervenants->where('code',$row['code'])->first();

            Hygiene::create([
                'type' => $row['type'],
                'description' => $row['description'],
                'effectif' => $row['effectif'],
                'intervenant_id' => $intervenant_id,
                'projet_id' => $projet_id,
                'localite_id' => $localite_id,
                'commune_id' => $commune_id
            ]);
        }
        //

    }
}
