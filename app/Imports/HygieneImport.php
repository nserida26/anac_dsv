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

class HygieneImport implements ToCollection,WithHeadingRow
{
    
    private $localites;
    private $communes;
    private $projets;
    private $intervenants;
    //public $message;
    public function __construct()
    {
        
        $this->localites = Localite::select('libele','id')->get(); 
        $this->projets = Projet::select('code','id')->get(); 
        $this->intervenants = Intervenant::select('id','code')->get(); 
        $this->communes = Commune::select('id','libele')->get(); 
        # code...
    }
    
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            # code...localite
            $localite_id = $this->localites->where('libele',$row['localite'])->first();
            $projet_id = $this->projets->where('code',$row['code_projet'])->first();
            //$localite_id = $this->localites->where('libele',$row['localite'])->first();
            $intervenant_id = $this->intervenants->where('code',$row['code_intervenant'])->first();

            Hygiene::create([
                'type' => $row['type'],
                'description' => $row['description'],
                'effectif' => $row['effectif'],
                'intervenant_id' => $intervenant_id->id,
                'projet_id' => $projet_id->id,
                'localite_id' => $localite_id->id
            ]);
        }
        //

    }
}
