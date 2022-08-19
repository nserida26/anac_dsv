<?php

namespace App\Imports;

use App\Models\Infrastructure;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Localite;
use App\Models\Projet;
use App\Models\Intervenant;
use App\Models\Commune;

use App\Models\Intervention;
use App\Models\Latrine;

class InfrasImport implements ToCollection, WithHeadingRow
{
    private $infrastructures;
    private $localites;
    private $communes;
    private $projets;
    private $intervenants;
    //public $message;
    public function __construct()
    {
        $this->infrastructures = Infrastructure::select('id')->get(); 
        $this->localites = Localite::select('id')->get(); 
        $this->projets = Projet::select('*')->get(); 
        $this->intervenants = Intervenant::select('id')->get(); 
        $this->communes = Commune::select('id')->get(); 
        # code...
    }
    //HeadingRowFormatter::default('none');
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        //
        foreach ($rows as $row) 
        {
            $localite_id = $this->localites->where('libele',$row['localite'])->first();
            $projet_id = $this->projets->where('code',$row['projet'])->first();
            $commune_id = $this->communes->where('libele',$row['commune'])->first();
            $intervenant_id = $this->intervenants->where('code',$row['code'])->first();
            
            $infrastructure_id = $this->infrastructures->where('logitude',$row['logitude'],'altitude',$row['altitude'])->first();
            
            if (!isset($infrastructure_id)) {
                # code...
                $infra = Infrastructure::create([ 
                    'designation' => $row['designation'],
                    'type' => $row['type'],
                    'annnee_construction' => $row['annnee_construction'],
                    'effectif' => $row['effectif'],
                    'source_eau' => $row['source_d_eau'],
                    'longitude' => $row['longitude'],
                    'altitude' => $row['altitude'],
                    'localite_id' => $localite_id,
                    'commune_id' => $commune_id
                ]);
                $infrastructure_id = $infra->id;
            }

            $intervention = Intervention::create([ 
                'designation' => $row['designation'],
                'type' => $row['type'],
                'montant' => $row['montant'],
                'avancement' => $row['avancement'],
                'projet_id' => $projet_id,
                'intervenant_id' => $intervenant_id
            ]);
            $intervention_id = $intervention->id;
            
            //$intervention_id = Intervention::select('id')->where('logitude',$row['logitude'],'altitude',$row['altitude'])->first()->get();
            InfrastructureIntervention::create([
                'infrastructure_id' => $infrastructure_id,
                'intervention_id' => $intervention_id
            ]);
            Latrine::create([
                'type_bloc' => $row['type_bloc'],
                'nbr_bloc' => $row['nbr_bloc'],
                'infrastructure_id' => $infrastructure_id
            ]);
        }
    }

}
